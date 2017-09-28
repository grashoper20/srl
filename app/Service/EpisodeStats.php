<?php

namespace SickRage\Service;

use Carbon\Carbon;
use Grashoper\GregorianOrdinal\Date;
use Illuminate\Cache\Repository;
use Illuminate\Database\Query\Builder as QueryBuilder;
use SickRage\Status;
use SickRage\tv_show;

class EpisodeStats
{
    /**
     * @var \Illuminate\Cache\Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getStat($show_id)
    {
        $stats = $this->getAllStats();
        if (!isset($stats[$show_id])) {
            return [];
        }

        return $stats[$show_id];
    }

    public function getAllStats()
    {
        return $this->repository->remember('episode_stats', 5, function () {
            return $this->doGetStatsByShowId();
        });
    }

    private function doGetStatsByShowId()
    {
        $stats = $this->doGetAllStats();
        $shows = tv_show::all(['show_id', 'indexer_id']);
        $results = [];
        foreach ($shows as $show) {
            $results[$show->show_id] = $stats[$show->indexer_id];
        }

        return $results;
    }

    private function doGetAllStats()
    {
        $status_snatched = [
            Status::SNATCHED,
            Status::SNATCHED_PROPER,
            Status::SNATCHED_BEST,
        ];
        $downloaded_where = function (QueryBuilder $query) {
            $query->orWhere('status', '>', 100); // Has combined quality status.
            $query->orWhere('status', '=', Status::ARCHIVED);
        };
        $snatched_sql = \DB::table('tv_episodes')
            ->selectRaw('showid, COUNT(episode_id) as snatched')
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->whereIn('status', $status_snatched)
            ->groupBy('showid');
        $downloaded_sql = \DB::table('tv_episodes')
            ->selectRaw('showid, COUNT(episode_id) as downloaded')
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->where($downloaded_where)
            ->groupBy('showid');
        $total_sql = \DB::table('tv_episodes')
            ->selectRaw('showid, COUNT(episode_id) as total')
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->where(function (QueryBuilder $query) use (
                $status_snatched,
                $downloaded_where
            ) {
                // If downloaded or downloading.
                $query->whereIn('status', $status_snatched);
                $query->orWhere($downloaded_where);
                // Or old and has a non-failure-ish state.
                $query->orWhere(function (QueryBuilder $query) {
                    $query->where('airdate', '<=',
                        Date::ordinalFromDate(Carbon::today()));
                    $query->whereIn('status',
                        [Status::SKIPPED, Status::WANTED, STATUS::FAILED]);
                });
            })
            ->groupBy('showid');
        $next_airs_sql = \DB::table('tv_episodes')
            ->selectRaw('showid, MIN(airdate) as next_air')
            ->where('airdate', '>=', Carbon::today())
            ->whereIn('status', [Status::UNAIRED, Status::WANTED])
            ->groupBy('showid');
        $previous_airs_sql = \DB::table('tv_episodes')
            ->selectRaw('showid, MAX(airdate) as previous_air')
            ->where('airdate', '>', 1)
            ->where('status', '<>', Status::UNAIRED)
            ->groupBy('showid');
        $show_size_sql = \DB::table('tv_episodes')
            ->selectRaw('showid, SUM(file_size) as show_size')
            ->groupBy('showid');

        /** @var \Illuminate\Database\Eloquent\Collection[] $stats */
        $stats = [
            'snatched'     => $snatched_sql->get(),
            'downloaded'   => $downloaded_sql->get(),
            'total'        => $total_sql->get(),
            'next_air'     => $next_airs_sql->get(),
            'previous_air' => $previous_airs_sql->get(),
            'show_size'    => $show_size_sql->get(),
        ];
        $result = [];
        foreach ($stats as $key => $collection) {
            foreach ($collection->keyBy('showid') as $indexer_id => $stat) {
                $result[$indexer_id][$key] = $stat->{$key};
            };
        }

        return $result;
    }


}
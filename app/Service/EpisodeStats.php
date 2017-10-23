<?php

namespace SRL\Service;

use Carbon\Carbon;
use Grashoper\GregorianOrdinal\Date;
use Illuminate\Cache\Repository;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use SRL\Status;
use SRL\tv_show;

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

    public function getStat($indexer_id)
    {
        $stats = $this->getAllStats();
        if (!isset($stats[$indexer_id])) {
            return new \stdClass();
        }

        return $stats[$indexer_id];
    }

    public function getAllStats()
    {
        return $this->repository->remember(
            'episode_stats',
            5,
            function () {
                return $this->doGetAllStats();
            }
        );
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
        $snatched = \DB::table('tv_episodes')
            ->selectRaw('showid, COUNT(episode_id) as snatched')
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->whereIn('status', $status_snatched)
            ->groupBy('showid')
            ->pluck('snatched', 'showid');
        $downloaded = \DB::table('tv_episodes')
            ->selectRaw('showid, COUNT(episode_id) as downloaded')
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->where($downloaded_where)
            ->groupBy('showid')
            ->pluck('downloaded', 'showid');
        $totals = \DB::table('tv_episodes')
            ->selectRaw('showid, COUNT(episode_id) as total')
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->where(
                function (QueryBuilder $query) use (
                    $status_snatched,
                    $downloaded_where
                ) {
                    // If downloaded or downloading.
                    $query->whereIn('status', $status_snatched);
                    $query->orWhere($downloaded_where);
                    // Or old and has a non-failure-ish state.
                    $query->orWhere(
                        function (QueryBuilder $query) {
                            $query->where(
                                'airdate',
                                '<=',
                                Date::ordinalFromDate(Carbon::today())
                            );
                            $query->whereIn(
                                'status',
                                [
                                    Status::SKIPPED,
                                    Status::WANTED,
                                    STATUS::FAILED,
                                ]
                            );
                        }
                    );
                }
            )
            ->groupBy('showid')
            ->pluck('total', 'showid');
        $today = Carbon::today();
        $next_airs = \DB::table('tv_episodes')
            ->selectRaw('showid, MIN(airdate) as next_air')
            ->where('airdate', '>=', Date::toOrdinal($today->year, $today->month, $today->day))
            ->whereIn('status', [Status::UNAIRED, Status::WANTED])
            ->groupBy('showid')
            ->pluck('next_air', 'showid');
        $previous_airs = \DB::table('tv_episodes')
            ->selectRaw('showid, MAX(airdate) as previous_air')
            ->where('airdate', '>', 1)
            ->where('status', '<>', Status::UNAIRED)
            ->groupBy('showid')
            ->pluck('previous_air', 'showid');
        $show_sizes = \DB::table('tv_episodes')
            ->selectRaw('showid, SUM(file_size) as show_size')
            ->groupBy('showid')
            ->pluck('show_size', 'showid');

        $show_stats = \DB::table('tv_shows')
            ->get(['indexer_id'])
            ->keyBy('indexer_id');
        foreach ($show_stats as $indexer_id => $stat) {
            $stat->indexer_id = (int)$indexer_id;
            $stat->snatched = (int)$snatched->get($indexer_id, 0);
            $stat->downloaded = (int)$downloaded->get($indexer_id, 0);
            $stat->total = (int)$totals->get($indexer_id, 0);
            $next = $next_airs->get($indexer_id, 0);
            $stat->next_airs = $next == 0 ? '' :
                Date::dateFromOrdinal($next)
                    ->format(\DateTime::RFC2822);
            $prev = $previous_airs->get($indexer_id, 0);
            $stat->previous_air = $prev == 0 ? '' :
                Date::dateFromOrdinal($prev)
                    ->format(\DateTime::RFC2822);
            $stat->show_size = (int)$show_sizes->get($indexer_id, 0);
        }

        return $show_stats->toArray();
    }

}

<?php

namespace SickRage\Http\Controllers;

use Illuminate\Database\Query\Builder as QueryBuilder;
use SickRage\tv_episode;

class ShowEpisodesController extends Controller
{

    public function index($show_id) {
        // Show Id is really indexer id. indexer id is not... its weird.
        $query = tv_episode::where('showid', function (QueryBuilder $query) use ($show_id) {
            $query->from('tv_shows')
                ->select('indexer_id')
                ->where('show_id', '=', $show_id);
        });
        return response()->json($query->get());
    }

    public function stats($show_id) {
        tv_episode::find(1);

        $status_quality = [];
        $status_download = [];
        $snatched_sql = \DB::table('tv_episodes')
            ->where('showid', $show_id)
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->whereIn('status', $status_quality);
        $downloaded_sql = \DB::table('tv_episodes')
            ->where('showid', $show_id)
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->whereIn('status', $status_download);
        $total_sql = \DB::table('tv_episodes')
            ->where('showid', $show_id)
            ->where('season', '>', 0)
            ->where('airdate', '>', 1)
            ->where(function ($query) {
                dd($query);
                //$query->or
            })
            // TODO Some magic to do some ands and ors and stuff...
            ->whereIn('status', $status_download);

        $query = 'SELECT showid,
  (SELECT COUNT(*)
   FROM tv_episodes
   WHERE showid = tv_eps.showid AND season > 0 AND episode > 0 AND airdate > 1 AND status IN :status_quality) AS ep_snatched,
  (SELECT COUNT(*)
   FROM tv_episodes
   WHERE showid = tv_eps.showid AND season > 0 AND episode > 0 AND airdate > 1 AND status IN :status_download) AS ep_downloaded,
  (SELECT COUNT(*)
   FROM tv_episodes
   WHERE showid = tv_eps.showid AND season > 0 AND episode > 0 AND airdate > 1
        AND (
        (airdate <= :today AND (status = :skipped_const OR status = :wanted_const OR status = :failed_const))
           OR (status IN :status_quality)
           OR (status IN :status_download)
         )) AS ep_total,
  (SELECT airdate
   FROM tv_episodes
   WHERE showid = tv_eps.showid AND airdate >= :today
        AND (status = :unaired_const OR status = :wanted_const)
   ORDER BY airdate ASC
   LIMIT 1) AS ep_airs_next,
  (SELECT airdate
   FROM tv_episodes
   WHERE showid = tv_eps.showid AND airdate > 1 AND status <> :unaired_const
   ORDER BY airdate DESC
   LIMIT 1) AS ep_airs_prev,
  (SELECT SUM(file_size)
   FROM tv_episodes
   WHERE showid = tv_eps.showid) AS show_size
FROM tv_episodes tv_eps
GROUP BY showid';
    }
}

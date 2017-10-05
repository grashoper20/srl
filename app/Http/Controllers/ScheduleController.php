<?php

namespace SRL\Http\Controllers;

use Carbon\Carbon;

class ScheduleController extends Controller
{

    public function get()
    {
        $next_week = strtotime("+1 week");
        $eps = $this->getComingEpisodes();

//        results = ComingEpisodes.get_coming_episodes(ComingEpisodes.categories, sickbeard.COMING_EPS_SORT, False)
//        today = datetime.datetime.now().replace(tzinfo=network_timezones.sb_timezone)
//
//        # Allow local overriding of layout parameter
//        if layout and layout in ('poster', 'banner', 'list', 'calendar'):
//            layout = layout
//        else:
//            layout = sickbeard.COMING_EPS_LAYOUT
//
//        t = PageTemplate(rh=self, filename='schedule.mako')
//        return t.render(next_week=next_week1, today=today, results=results, layout=layout,
//                title=_('Schedule'), header=_('Schedule'), topmenu='schedule',
//                controller="schedule", action="index")
    }


    private function getComingEpisodes()
    {
        $missed_range = 7; // TODO Configurable?

        $today = strtotime('today midnight');
        $recent = strtotime('-' . $missed_range . 'days midnight');
        $future = strtotime('+7days midnight');

        dd([
            Carbon::createFromTimestamp($today)->toIso8601String(),
            Carbon::createFromTimestamp($recent)->toIso8601String(),
            Carbon::createFromTimestamp($future)->toIso8601String(),
        ]);
//        categories = ComingEpisodes._get_categories(categories)
//        sort = ComingEpisodes._get_sort(sort)
//
//        today = date.today().toordinal()
//        recently = (date.today() - timedelta(days=sickbeard.COMING_EPS_MISSED_RANGE)).toordinal()
//        next_week = (date.today() + timedelta(days=7)).toordinal()
//
//        db = DBConnection(row_type='dict')
//        fields_to_select = ', '.join(
//                ['airdate', 'airs', 'e.description as description', 'episode', 'imdb_id', 'e.indexer', 'indexer_id',
//                    'e.location', 'name', 'network', 'paused', 'quality', 'runtime', 'season', 'show_name', 'showid',
//                    'e.status as epstatus', 's.status']
//            )
//
//        status_list = [WANTED, UNAIRED] + SNATCHED
//
//        sql_l = []
//        for show_obj in sickbeard.showList:
//            next_air_date = show_obj.nextEpisode()
//            sql_l.append(
//                [
//                    'SELECT DISTINCT {0} '.format(fields_to_select) +
//                    'FROM tv_episodes e, tv_shows s '
//                    'WHERE showid = ? '
//                    'AND airdate <= ? '
//                    'AND airdate >= ? '
//                    'AND s.indexer_id = e.showid '
//                    'AND e.status IN (' + ','.join(['?'] * len(status_list)) + ')',
//                    [show_obj.indexerid, next_air_date or today, recently] + status_list
//                ]
//            )
//
//        results = []
//        for sql_i in sql_l:
//            if results:
//                results += db.select(*sql_i)
//            else:
//                results = db.select(*sql_i)
//
//        for index, item in enumerate(results):
//            results[index][b'localtime'] = sbdatetime.convert_to_setting(
//                    parse_date_time(item[b'airdate'], item[b'airs'], item[b'network']))
//            results[index][b'snatchedsort'] = int(not results[index][b'epstatus'] in SNATCHED)
//
//        results.sort(key=ComingEpisodes.sorts[sort])
//
//        if not group:
//            return results
//
//        grouped_results = ComingEpisodes._get_categories_map(categories)
//
//        for result in results:
//            if result[b'paused'] and not paused:
//            continue
//
//            result[b'airs'] = str(result[b'airs']).replace('am', ' AM').replace('pm', ' PM').replace('  ', ' ')
//            result[b'airdate'] = result[b'localtime'].toordinal()
//
//            if result[b'epstatus'] in SNATCHED:
//                if result[b'location']:
//                    continue
//                else:
//                    category = 'snatched'
//            elif result[b'airdate'] < today:
//                category = 'missed'
//            elif result[b'airdate'] >= next_week:
//                category = 'later'
//            elif result[b'airdate'] == today:
//                category = 'today'
//            else:
//                category = 'soon'
//
//            if len(categories) > 0 and category not in categories:
//                continue
//
//            if not result[b'network']:
//                result[b'network'] = ''
//
//            result[b'quality'] = get_quality_string(result[b'quality'])
//            result[b'airs'] = sbdatetime.sbftime(result[b'localtime'], t_preset=timeFormat).lstrip('0').replace(' 0', ' ')
//            result[b'weekday'] = 1 + result[b'localtime'].weekday()
//            result[b'tvdbid'] = result[b'indexer_id']
//            result[b'airdate'] = sbdatetime.sbfdate(result[b'localtime'], d_preset=dateFormat)
//            result[b'localtime'] = result[b'localtime'].toordinal()
//
//            grouped_results[category].append(result)
//
//            return grouped_results
    }
}

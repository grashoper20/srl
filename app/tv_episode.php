<?php

namespace SickRage;

use Illuminate\Database\Eloquent\Model;

/**
 * SickRage\tv_episodes
 *
 * @property int|null $episode_id
 * @property float|null $showid
 * @property float|null $indexerid
 * @property string|null $indexer
 * @property string|null $name
 * @property float|null $season
 * @property float|null $episode
 * @property string|null $description
 * @property float|null $airdate
 * @property float|null $hasnfo
 * @property float|null $hastbn
 * @property float|null $status
 * @property string|null $location
 * @property float|null $file_size
 * @property string|null $release_name
 * @property string|null $subtitles
 * @property float|null $subtitles_searchcount
 * @property string|null $subtitles_lastsearch
 * @property float|null $is_proper
 * @property float|null $scene_season
 * @property float|null $scene_episode
 * @property float|null $absolute_number
 * @property float|null $scene_absolute_number
 * @property float|null $version
 * @property string|null $release_group
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereAbsoluteNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereAirdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereEpisode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereEpisodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereHasnfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereHastbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereIndexer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereIndexerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereIsProper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereReleaseGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereReleaseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereSceneAbsoluteNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereSceneEpisode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereSceneSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereShowid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereSubtitles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereSubtitlesLastsearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereSubtitlesSearchcount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\tv_episode whereVersion($value)
 * @mixin \Eloquent
 */
class tv_episode extends Model
{
    protected $primaryKey = 'episode_id';

    # Episode statuses
    const UNKNOWN = -1;  # should never happen
    const UNAIRED = 1;  # episodes that haven't aired yet
    const SNATCHED = 2;  # qualified with quality
    const WANTED = 3;  # episodes we don't have but want to get
    const DOWNLOADED = 4;  # qualified with quality
    const SKIPPED = 5;  # episodes we don't want
    const ARCHIVED = 6;  # episodes that you don't have locally (counts toward download completion stats)
    const IGNORED = 7;  # episodes that you don't want included in your download stats
    const SNATCHED_PROPER = 9;  # qualified with quality
    const SUBTITLED = 10;  # qualified with quality
    const FAILED = 11;  # episode downloaded or snatched we don't want
    const SNATCHED_BEST = 12;  # episode re-downloaded using best quality

}

<?php

namespace SRL;

use Grashoper\GregorianOrdinal\Date;
use Illuminate\Database\Eloquent\Model;

/**
 * SRL\tv_episodes
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
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereAbsoluteNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereAirdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereEpisode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereEpisodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereHasnfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereHastbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereIndexer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereIndexerid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereIsProper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereReleaseGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereReleaseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereSceneAbsoluteNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereSceneEpisode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereSceneSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereShowid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereSubtitles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereSubtitlesLastsearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereSubtitlesSearchcount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_episode whereVersion($value)
 * @mixin \Eloquent
 */
class tv_episode extends Model
{
    protected $primaryKey = 'episode_id';

    protected $hidden = [
        'indexerid',
        //probably a key but no unique requirement or index in db so...
        // for now internal only.
        'indexer',
        'scene_season',
        'scene_episode',
//        'absolute_number',
        'scene_absolute_number',
        'version',
        'release_group',
        'is_proper',
        'release_name',
        'subtitles_searchcount',
        'subtitles_lastsearch',
    ];

    protected $casts = [
        'showid'            => 'integer',
        'season'            => 'integer',
        'episode'           => 'integer',
        'hasnfo'            => 'boolean',
        'hastbn'            => 'boolean',
        'status'            => 'integer',
        'file_size'         => 'integer',
        //
        'flatten_folders'   => 'boolean',
        'paused'            => 'boolean',
        'subtitles'         => 'boolean',
        'anime'             => 'boolean',
        'scene'             => 'boolean',
        'default_ep_status' => 'integer',
    ];

    protected $appends = ['real_status', 'quality'];

    public function getAirdateAttribute($value)
    {
        return $value > 1
            ? Date::dateFromOrdinal($value)
                ->format(DATE_RFC2822)
            : $value;
    }

    public function setAirdateAttribute($value)
    {
        return Date::ordinalFromDate($value);
    }

    public function getRealStatusAttribute()
    {
        return Quality::splitCompositeStatus($this->status)[0];
    }

    public function getQualityAttribute()
    {
        $return = [];
        // While handy in php, sparse arrays don't do well in vue so convert it to something it can handle better.
        $qualities = Quality::getQualityText(Quality::splitCompositeStatus($this->status)[1]);
        foreach ($qualities as $id => $quality) {
            $return[] = [
                'id' => $id,
                'quality' => $quality,
            ];
        }
        return $return;
    }

    public function show()
    {
        // Show ID is the show indexer id not the show id and indexer_id is the
        // episode indexer id. Confusing but its the way things are.
        return $this->belongsTo(tv_show::class, 'showid');
    }

}

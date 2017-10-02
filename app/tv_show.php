<?php

namespace SRL;

use Grashoper\GregorianOrdinal\Date;
use Illuminate\Database\Eloquent\Model;
use SRL\Service\EpisodeStats;

/**
 * SRL\tv_show
 *
 * @property int|null $show_id
 * @property float|null $indexer_id
 * @property float|null $indexer
 * @property string|null $show_name
 * @property string|null $location
 * @property string|null $network
 * @property string|null $genre
 * @property string|null $classification
 * @property float|null $runtime
 * @property float|null $quality
 * @property string|null $airs
 * @property string|null $status
 * @property float|null $flatten_folders
 * @property float|null $paused
 * @property float|null $startyear
 * @property float|null $air_by_date
 * @property string|null $lang
 * @property float|null $subtitles
 * @property string|null $notify_list
 * @property string|null $imdb_id
 * @property float|null $last_update_indexer
 * @property float|null $dvdorder
 * @property float|null $archive_firstmatch
 * @property string|null $rls_require_words
 * @property string|null $rls_ignore_words
 * @property float|null $sports
 * @property float|null $anime
 * @property float|null $scene
 * @property float|null $default_ep_status
 * @property float|null $tmdb_id
 * @property float|null $sub_use_sr_metadata
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereAirByDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereAirs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereAnime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereArchiveFirstmatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereDefaultEpStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereDvdorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereFlattenFolders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereIndexer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereIndexerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereLastUpdateIndexer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereNetwork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereNotifyList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show wherePaused($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereRlsIgnoreWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereRlsRequireWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereRuntime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereScene($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereShowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereShowName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereSports($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereStartyear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereSubUseSrMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereSubtitles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\tv_show whereTmdbId($value)
 * @mixin \Eloquent
 */
class tv_show extends Model
{
    protected $primaryKey = 'indexer_id';

    protected $appends = ['progress', 'stats'];

    protected $hidden = [
        'show_id', // useless.
        // for now internal only.
        'indexer',
        'last_update_indexer',
        'tmpdb_id',
        'dvd_order',
        'archive_fist_match',
    ];

    protected $casts = [
        'runtime'             => 'integer',
        'quality'             => 'integer',
        'flatten_folders'     => 'boolean',
        'paused'              => 'boolean',
        'subtitles'           => 'boolean',
        'sub_use_sr_metadata' => 'boolean',
        'anime'               => 'boolean',
        'sports'              => 'boolean',
        'scene'               => 'boolean',
        'default_ep_status'   => 'integer',
        'air_by_date'         => 'boolean',
        'dvdorder'            => 'boolean',
    ];

    public function getProgressAttribute()
    {
        $show_stats = static::getStats()->getStat($this->indexer_id);
        if (empty($show_stats->total)) {
            return 0;
        }

        return $show_stats->downloaded / $show_stats->total;
    }

    public function getStatsAttribute()
    {
        return static::getStats()->getStat($this->indexer_id);
    }

    /**
     * @return mixed|\SRL\Service\EpisodeStats
     */
    private static function getStats()
    {
        static $stats_service;
        if (!isset($stats_service)) {
            $stats_service = app()->make(EpisodeStats::class);
        }

        return $stats_service;
    }

}

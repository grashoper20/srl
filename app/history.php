<?php

namespace SRL;

use Carbon\Carbon;
use Grashoper20\VueTables\VueTablesTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * SRL\history
 *
 * @property float|null $action
 * @property float|null $date
 * @property float|null $showid
 * @property float|null $season
 * @property float|null $episode
 * @property float|null $quality
 * @property string|null $resource
 * @property string|null $provider
 * @property float|null $version
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereEpisode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereSeason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereShowid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SRL\history whereVersion($value)
 * @mixin \Eloquent
 */
class history extends Model
{

    use VueTablesTrait;

    protected $table = 'history';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        static::$vueTablesSearchFields = [
            'resource',
            'provider',
        ];
    }

    public function show()
    {
        // Show ID is the show indexer id not the show id and indexer_id is the
        // episode indexer id. Confusing but its the way things are.
        return $this->belongsTo(tv_show::class, 'showid');
    }

    public function getResourceAttribute($value)
    {
        return pathinfo($value, PATHINFO_BASENAME);
    }

    public function getActionAttribute($value)
    {
        return Quality::splitCompositeStatus($value);
    }

    public function getQualityAttribute($value)
    {
        $return = [];
        // While handy in php, sparse arrays don't do well in vue so convert it to something it can handle better.
        $qualities = Quality::getQualityText($value);
        foreach ($qualities as $id => $quality) {
            $return[] = [
                'id'      => $id,
                'quality' => $quality,
            ];
        }

        // There should only ever be one quality.
        return $return[0];
    }

    public function getDateAttribute($value)
    {
        return Carbon::createFromFormat('YmdHis', $value)
            ->toRfc2822String();
    }

}

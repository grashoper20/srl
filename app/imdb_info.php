<?php

namespace SickRage;

use Illuminate\Database\Eloquent\Model;

/**
 * SickRage\imdb_info
 *
 * @property int $indexer_id
 * @property string|null $imdb_id
 * @property string|null $title
 * @property float|null $year
 * @property string|null $akas
 * @property float|null $runtimes
 * @property string|null $genres
 * @property string|null $countries
 * @property string|null $country_codes
 * @property string|null $certificates
 * @property string|null $rating
 * @property int|null $votes
 * @property float|null $last_update
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereAkas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereCertificates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereCountries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereCountryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereGenres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereIndexerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereLastUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereRuntimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereVotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\SickRage\imdb_info whereYear($value)
 * @mixin \Eloquent
 */
class imdb_info extends Model
{
    protected $primaryKey = 'indexer_id';
    protected $table = 'imdb_info';
}

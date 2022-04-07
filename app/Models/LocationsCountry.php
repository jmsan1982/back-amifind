<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LocationsCountry
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 * @property bool $favourite
 *
 * @package App\Models
 */
class LocationsCountry extends Model
{
	protected $table = 'locations_countries';
	public $timestamps = false;

	protected $casts = [
		'favourite' => 'bool'
	];

	protected $fillable = [
		'name',
		'code',
		'favourite'
	];
}

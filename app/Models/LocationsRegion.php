<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LocationsRegion
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $country_id
 *
 * @package App\Models
 */
class LocationsRegion extends Model
{
	protected $table = 'locations_regions';
	public $timestamps = false;

	protected $casts = [
		'country_id' => 'int'
	];

	protected $fillable = [
		'name',
		'code',
		'country_id'
	];
}

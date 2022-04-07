<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * 
 * @property int $id
 * @property int $region_id
 * @property int $country_id
 * @property float $latitude
 * @property float $longitude
 * @property string $name
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Location extends Model
{
	protected $table = 'locations';
	public $timestamps = false;

	protected $casts = [
		'region_id' => 'int',
		'country_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'region_id',
		'country_id',
		'latitude',
		'longitude',
		'name'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}

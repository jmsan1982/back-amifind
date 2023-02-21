<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * 
 * @property int $id
 * @property int $id_user
 * @property string|null $avatar
 * @property string|null $description
 * @property int|null $location_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property Carbon|null $birth_date
 * @property string|null $gender
 * @property string|null $marital_status
 * @property string $searching
 * @property int $search_age_from
 * @property int $search_age_to
 * @property int|null $search_distance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Profile extends Model
{
	protected $table = 'profile';

	protected $casts = [
		'id_user' => 'int',
		'location_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float',
		'search_age_from' => 'int',
		'search_age_to' => 'int',
		'search_distance' => 'int'
	];

	protected $dates = [
		'birth_date'
	];

	protected $fillable = [
		'id_user',
		'avatar',
		'description',
		'location_id',
		'latitude',
		'longitude',
		'birth_date',
		'gender',
		'marital_status',
		'searching',
		'search_age_from',
		'search_age_to',
		'search_distance'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}

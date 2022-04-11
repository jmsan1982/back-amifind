<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $email
 * @property string $userName
 * @property string $password
 * @property string|null $avatar
 * @property string|null $role
 * @property string|null $name
 * @property string|null $description
 * @property int|null $location_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property Carbon|null $date_birth
 * @property string|null $gender
 * @property string|null $civil_status
 * @property string $searching
 * @property int $search_age_from
 * @property int $search_age_to
 * @property int|null $search_distance
 * @property Carbon|null $last_activity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $remember_token
 * 
 * @property Location|null $location
 * @property Collection|HobbiesUser[] $hobbies_users
 * @property Collection|Photo[] $photos
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'location_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float',
		'search_age_from' => 'int',
		'search_age_to' => 'int',
		'search_distance' => 'int'
	];

	protected $dates = [
		'date_birth',
		'last_activity'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email',
		'userName',
		'password',
		'avatar',
		'role',
		'name',
		'description',
		'location_id',
		'latitude',
		'longitude',
		'date_birth',
		'gender',
		'civil_status',
		'searching',
		'search_age_from',
		'search_age_to',
		'search_distance',
		'last_activity',
		'remember_token'
	];

	public function location()
	{
		return $this->belongsTo(Location::class);
	}

	public function hobbies_users()
	{
		return $this->hasMany(HobbiesUser::class);
	}

	public function photos()
	{
		return $this->hasMany(Photo::class);
	}
}

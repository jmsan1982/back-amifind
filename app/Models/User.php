<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $rol
 * @property Carbon|null $last_activity
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|HobbiesUser[] $hobbies_users
 * @property Collection|Photo[] $photos
 * @property Collection|Profile[] $profiles
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'users';

	protected $dates = [
		'email_verified_at',
		'last_activity'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'rol',
		'last_activity',
		'remember_token'
	];

	public function hobbies_users()
	{
		return $this->hasMany(HobbiesUser::class);
	}

	public function photos()
	{
		return $this->hasMany(Photo::class);
	}

	public function profiles()
	{
		return $this->hasMany(Profile::class, 'id_user');
	}
}

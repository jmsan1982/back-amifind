<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HobbiesUser
 * 
 * @property int $id
 * @property int $user_id
 * @property int $hobby_id
 * @property Carbon|null $created_at
 * 
 * @property Hobby $hobby
 * @property User $user
 *
 * @package App\Models
 */
class HobbiesUser extends Model
{
	protected $table = 'hobbies_users';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'hobby_id' => 'int'
	];

	public function hobby()
	{
		return $this->belongsTo(Hobby::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

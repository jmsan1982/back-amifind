<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Hobby
 * 
 * @property int $id
 * @property string $name
 * @property string $status
 * @property string|null $image
 * @property bool $has_forum
 * @property bool $has_chat
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HobbiesUser[] $hobbies_users
 *
 * @package App\Models
 */
class Hobby extends Model
{
	protected $table = 'hobbies';

	protected $casts = [
		'has_forum' => 'bool',
		'has_chat' => 'bool'
	];

	protected $fillable = [
		'name',
		'status',
		'image',
		'has_forum',
		'has_chat'
	];

	public function hobbies_users()
	{
		return $this->hasMany(HobbiesUser::class);
	}
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Forum
 * 
 * @property int $id
 * @property int $user_id
 * @property int|null $hobby_id
 * @property int|null $location_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int|null $parent_id
 * @property string|null $title
 * @property string $message
 * @property Carbon $last_answer
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Forum extends Model
{
	protected $table = 'forums';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'hobby_id' => 'int',
		'location_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float',
		'parent_id' => 'int'
	];

	protected $dates = [
		'last_answer'
	];

	protected $fillable = [
		'id',
		'user_id',
		'hobby_id',
		'location_id',
		'latitude',
		'longitude',
		'parent_id',
		'title',
		'message',
		'last_answer'
	];
}

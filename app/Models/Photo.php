<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 * 
 * @property int $id
 * @property string $url
 * @property string $album_type
 * @property string $status
 * @property int $user_id
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Photo extends Model
{
	protected $table = 'photos';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'url',
		'album_type',
		'status',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}

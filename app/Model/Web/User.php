<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 *
 * @property int id
 * @property string name
 * @property string password
 * @property string remember_token
 * @property int cash_point
 * @property int vote_point
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class User extends Authenticatable
{
	use Notifiable;
	use SoftDeletes;

	/** @var array */
	protected $fillable = [
		'name',
		'email',
		'password'
	];

	/** @var array */
	protected $hidden = [
		'password',
		'remember_token'
	];

	/** @var array */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];
}

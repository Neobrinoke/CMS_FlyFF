<?php

namespace App\Model\Web;

use Carbon\Carbon;
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
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class User extends Authenticatable
{
	use Notifiable;

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
}

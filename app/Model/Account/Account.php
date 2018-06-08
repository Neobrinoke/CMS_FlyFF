<?php

namespace App\Model\Account;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Model\Account
 *
 * @property string account
 * @property string password
 * @property string isuse
 * @property string member
 * @property string id_no1
 * @property string id_no2
 * @property string realname
 * @property string reload
 * @property string OldPassword
 * @property string TempPassword
 * @property int cash
 * @property int votes
 * @property int vote_jeu
 * @property int vote_total
 */
class Account extends Model
{
	protected $connection = 'account';
	protected $table = 'ACCOUNT_TBL';
	protected $fillable = [
		'account', 'password',
		'isuse', 'member',
		'id_no1', 'id_no2',
		'realname', 'reload',
		'OldPassword', 'TempPassword',
		'cash', 'votes',
		'vote_jeu', 'vote_total'
	];
}

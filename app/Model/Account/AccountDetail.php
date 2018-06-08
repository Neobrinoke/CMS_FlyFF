<?php

namespace App\Model\Account;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Model\Account
 *
 * @property string account
 * @property string gamecode
 * @property string tester
 * @property string m_chLoginAuthority
 * @property Carbon regdate
 * @property string BlockTime
 * @property string EndTime
 * @property string WebTime
 * @property string isuse
 * @property Carbon secession
 * @property string email
 */
class AccountDetail extends Model
{
	/** @var string */
	protected $connection = 'account';

	/** @var string */
	protected $table = 'ACCOUNT_TBL_DETAIL';

	/** @var array */
	protected $fillable = [
		'account',
		'gamecode',
		'tester',
		'm_chLoginAuthority',
		'regdate',
		'BlockTime',
		'EndTime',
		'WebTime',
		'isuse',
		'secession',
		'email'
	];
}

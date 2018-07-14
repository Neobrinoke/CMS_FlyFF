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
 * @property string BlockTime
 * @property string EndTime
 * @property string WebTime
 * @property string isuse
 * @property string email
 * @property Carbon secession
 * @property Carbon regdate
 */
class AccountDetail extends Model
{
    /** @var string */
    protected $connection = 'account';

    /** @var string */
    protected $table = 'ACCOUNT_TBL_DETAIL';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $fillable = [
        'account',
        'gamecode',
        'tester',
        'm_chLoginAuthority',
        'BlockTime',
        'EndTime',
        'WebTime',
        'isuse',
        'email',
        'secession',
        'regdate',
    ];

    /** @var array */
    protected $dates = [
        'secession',
        'regdate'
    ];
}

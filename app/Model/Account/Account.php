<?php

namespace App\Model\Account;

use App\Model\Character\Character;
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
 * @property AccountDetail detail
 */
class Account extends Model
{
    /** @var string */
    protected $connection = 'account';

    /** @var string */
    protected $table = 'ACCOUNT_TBL';

    /** @var bool */
    public $timestamps = false;

    /**
     * Return the detail for this account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(AccountDetail::class, 'account', 'account');
    }

    /**
     * Return all characters for this account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters()
    {
        return $this->hasMany(Character::class, 'account', 'account');
    }
}

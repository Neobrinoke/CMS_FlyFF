<?php

namespace App\Model\Account;

use App\Model\Character\Character;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
 * @property int user_id
 *
 * @property Collection characters
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

    /** @var array */
    protected $fillable = [
        'account',
        'password',
        'isuse',
        'member',
        'id_no1',
        'id_no2',
        'realname',
        'reload',
        'OldPassword',
        'TempPassword',
        'user_id'
    ];

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
        return $this->hasMany(Character::class, 'account', 'account')->valid();
    }
}

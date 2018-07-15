<?php

namespace App\Model\Account;

use App\Model\Character\Character;
use Carbon\Carbon;
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
 * @property bool is_mine
 * @property bool is_banned
 * @property string status
 * @property Collection characters
 * @property AccountDetail detail
 */
class Account extends Model
{
    /** @var string */
    protected $primaryKey = 'account';

    /** @var bool */
    public $incrementing = false;

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

    /**
     * Return true if is an account of current logged user.
     *
     * @return bool
     */
    public function getIsMineAttribute(): bool
    {
        return (int)$this->user_id === (int)auth()->id();
    }

    /**
     * Determine if this account is banned or not.
     *
     * @return bool
     */
    public function getIsBannedAttribute(): bool
    {
        return (int)$this->detail->BlockTime >= (int)Carbon::now()->format('Ymd');
    }

    /**
     * Return current status for this account.
     *
     * @return string
     */
    public function getStatusAttribute(): string
    {
        return $this->is_banned ? trans('trans/settings.general.index.statuses.banned') : trans('trans/settings.general.index.statuses.valid');
    }
}

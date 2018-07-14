<?php

namespace App\Model\Web;

use App\Model\Account\Account;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

/**
 * Class User
 * @package App
 *
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string remember_token
 * @property int cash_point
 * @property int vote_point
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property Collection accounts
 * @property Collection characters
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

    /**
     * Return all game accounts for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Return all characters for this user.
     *
     * @return Collection
     */
    public function getCharactersAttribute(): Collection
    {
        $characters = new Collection();

        $this->accounts->each(function (Account $account) use (&$characters) {
            $characters = $characters->merge($account->characters);
        });

        return $characters;
    }
}

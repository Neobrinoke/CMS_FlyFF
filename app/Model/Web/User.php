<?php

namespace App\Model\Web;

use App\Model\Account\Account;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
 * @property string avatar_url
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property string avatar_image
 * @property Collection characters
 *
 * @property Collection accounts
 * @property Collection tickets
 * @property Collection logs
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cash_point',
        'vote_point',
        'avatar_url',
    ];

    /** @var array */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @var array */
    protected $casts = [
        'cash_point' => 'int',
        'vote_point' => 'int',
    ];


    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
     * Return all tickets for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'author_id', 'id');
    }

    /**
     * Return all logs for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(UserLog::class)->orderByDesc('performed_at');
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
            if (!$account->is_banned) {
                $characters = $characters->merge($account->characters);
            }
        });

        return $characters;
    }

    /**
     * Return avatar image for this user.
     *
     * @return null|string
     */
    public function getAvatarImageAttribute(): ?string
    {
        return asset($this->avatar_url);
    }
}

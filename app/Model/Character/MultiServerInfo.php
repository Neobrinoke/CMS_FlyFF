<?php

namespace App\Model\Character;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuildMember
 * @package App\Model\Character
 *
 * @property string serverindex
 * @property string m_idPlayer
 * @property int MultiServer
 *
 * @property bool is_online
 * @property string status
 *
 * @property Character player
 *
 * @method static Builder connected()
 */
class MultiServerInfo extends Model
{
    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'tblMultiServerInfo';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $casts = [
        'MultiServer' => 'int'
    ];

    /**
     * Retrieve all connected players.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function allConnected()
    {
        return self::connected()->get();
    }

    /**
     * Get count of connected players.
     *
     * @return int
     */
    public static function getConnectedCount()
    {
        return self::connected()->count();
    }

    /**
     * Only connected players.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeConnected(Builder $builder): Builder
    {
        return $builder->where('MultiServer', '>', 0);
    }

    /**
     * Return player for this online member info.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player()
    {
        return $this->belongsTo(Character::class, 'm_idPlayer', 'm_idPlayer');
    }

    /**
     * Detect if user is online or not.
     *
     * @return bool
     */
    public function getIsOnlineAttribute(): bool
    {
        return $this->MultiServer > 0;
    }

    /**
     * Return online status.
     *
     * @return string
     */
    public function getStatusAttribute(): string
    {
        return $this->is_online ? trans('online_status.online') : trans('online_status.offline');
    }
}

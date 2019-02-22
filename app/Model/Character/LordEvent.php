<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LordEvent
 * @package App\Model\Character
 *
 * @property int nServer
 * @property int idPlayer
 * @property int nTick
 * @property float fEFactor
 * @property float fIFactor
 * @property Carbon s_date
 *
 * @property string player_id
 * @property string message
 * @property string details
 *
 * @property Character player
 */
class LordEvent extends Model
{
    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'tblLordEvent';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $casts = [
        'nServer' => 'int',
        'idPlayer' => 'int',
        'nTick' => 'int',
        'fEFactor' => 'float',
        'fIFactor' => 'float',
    ];

    /** @var array */
    protected $dates = [
        's_date',
    ];

    /**
     * Return current lord event.
     *
     * @return LordEvent|null
     */
    public static function getCurrent(): ?LordEvent
    {
        return self::query()
            ->where('nTick', '>', '0')
            ->orderByDesc('s_date')
            ->get()
            ->first();
    }

    /**
     * Return player for this lord event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function player()
    {
        return $this->hasOne(Character::class, 'm_idPlayer', 'player_id');
    }

    /**
     * Return formatted idPlayer.
     *
     * @return string
     */
    public function getPlayerIdAttribute(): string
    {
        return substr('0000000', 0, 7 - strlen($this->idPlayer)) . $this->idPlayer;
    }

    /**
     * Return message for this lord event.
     *
     * @return string
     */
    public function getMessageAttribute(): string
    {
        return trans('aside.hall_of_fame.event_time_remaining', ['time' => $this->nTick]);
    }

    /**
     * Return details for this lord event.
     *
     * @return string
     */
    public function getDetailsAttribute(): string
    {
        return "Exp: x{$this->fEFactor} \nPenyas: x{$this->fIFactor} \nAuteur: {$this->player->m_szName}";
    }
}

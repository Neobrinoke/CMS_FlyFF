<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CombatInfo
 * @package App\Model\Character
 *
 * @property int CombatID
 * @property string serverindex
 * @property string Status
 * @property string Comment
 * @property int SEQ
 * @property Carbon StartDt
 * @property Carbon EndDt
 *
 * @property CombatJoinPlayer joinPlayer
 * @property CombatJoinGuild joinGuild
 */
class CombatInfo extends Model
{
    /** @var string */
    protected $primaryKey = 'CombatID';

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'tblCombatInfo';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $casts = [
        'CombatID' => 'int',
        'SEQ' => 'int'
    ];

    /** @var array */
    protected $dates = [
        'StartDt',
        'EndDt'
    ];

    /**
     * Return the last one played GS.
     *
     * @return CombatInfo|null
     */
    public static function getLastOnePlayed(): ?CombatInfo
    {
        return self::query()->where('Status', '=', '30')->get()->first();
    }

    /**
     * Return joinPlayer relation for this GS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function joinPlayer()
    {
        // TODO: passer en HasMany si c'est du One to Many
        return $this->hasOne(CombatJoinPlayer::class, 'CombatID', 'CombatID')->orderByDesc('CombatID');
    }

    /**
     * Return joinPlayer relation for this GS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function joinGuild()
    {
        // TODO: passer en HasMany si c'est du One to Many
        return $this->hasOne(CombatJoinGuild::class, 'CombatID', 'CombatID')->orderByDesc('CombatID');
    }
}

<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CombatJoinGuild
 * @package App\Model\Character
 *
 * @property int CombatID
 * @property string serverindex
 * @property string GuildID
 * @property string Status
 * @property int CombatFee
 * @property int ReturnCombatFee
 * @property int Reward
 * @property int Point
 * @property int StraightWin
 * @property int SEQ
 * @property Carbon RewardDt
 * @property Carbon CancelDt
 * @property Carbon ApplyDt
 *
 * @property Guild guild
 */
class CombatJoinGuild extends Model
{
    /** @var string */
    protected $primaryKey = 'CombatID';

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'tblCombatJoinGuild';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $casts = [
        'CombatID' => 'int',
        'CombatFee' => 'int',
        'ReturnCombatFee' => 'int',
        'Reward' => 'int',
        'Point' => 'int',
        'StraightWin' => 'int',
        'SEQ' => 'int',
    ];

    /** @var array */
    protected $dates = [
        'RewardDt',
        'CancelDt',
        'ApplyDt',
    ];

    /**
     * Return guild for this combat join guild.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function guild()
    {
        return $this->hasOne(Guild::class, 'm_idGuild', 'GuildID');
    }
}

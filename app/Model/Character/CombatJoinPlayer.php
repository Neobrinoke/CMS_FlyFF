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
 * @property string GuildID
 * @property string PlayerID
 * @property string Status
 * @property int Point
 * @property int Reward
 * @property Carbon RewardDt
 *
 * @property Character player
 */
class CombatJoinPlayer extends Model
{
    /** @var string */
    protected $primaryKey = 'CombatID';

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'tblCombatJoinPlayer';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $dates = [
        'RewardDt'
    ];

    public function player()
    {
        return $this->hasOne(Character::class, 'm_idPlayer', 'PlayerID');
    }
}

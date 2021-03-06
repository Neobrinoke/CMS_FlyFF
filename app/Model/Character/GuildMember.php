<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuildMember
 * @package App\Model\Character
 *
 * @property string m_idPlayer
 * @property string serverindex
 * @property string m_idGuild
 * @property string m_szAlias
 * @property int m_nWin
 * @property int m_nLose
 * @property int m_nSurrender
 * @property int m_nMemberLv
 * @property int m_nGiveGold
 * @property int m_nGivePxp
 * @property int m_idWar
 * @property int m_idVote
 * @property string isuse
 * @property int m_nClass
 * @property Carbon CreateTime
 *
 * @property string rank_logo
 * @property string rank_title
 *
 * @property Guild guild
 * @property Character player
 */
class GuildMember extends Model
{
    public const RANK_MASTER = 0;
    public const RANK_GENERAL = 1;
    public const RANK_OFFICER = 2;
    public const RANK_VETERAN = 3;
    public const RANK_MEMBER = 4;

    public const RANKS = [
        self::RANK_MASTER => 'master',
        self::RANK_GENERAL => 'general',
        self::RANK_OFFICER => 'officer',
        self::RANK_VETERAN => 'veteran',
        self::RANK_MEMBER => 'member',
    ];

    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'GUILD_MEMBER_TBL';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $casts = [
        'm_nWin' => 'int',
        'm_nLose' => 'int',
        'm_nSurrender' => 'int',
        'm_nMemberLv' => 'int',
        'm_nGiveGold' => 'int',
        'm_nGivePxp' => 'int',
        'm_idWar' => 'int',
        'm_idVote' => 'int',
        'm_nClass' => 'int',
    ];

    /** @var array */
    protected $dates = [
        'CreateTime',
    ];

    /**
     * Return guild for this guild member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guild()
    {
        return $this->belongsTo(Guild::class, 'm_idGuild', 'm_idGuild');
    }

    /**
     * Return player for this guild member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player()
    {
        return $this->belongsTo(Character::class, 'm_idPlayer', 'm_idPlayer');
    }

    /**
     * Return name of logo for his rank or null (it's not supposed to happen).
     *
     * @return null|string
     */
    public function getRankLogoAttribute(): ?string
    {
        $name = ucfirst(self::RANKS[$this->m_nMemberLv]);

        return asset(sprintf("/images/guilds/%s.png", $name));
    }

    /**
     * Return name of logo for his rank or null (it's not supposed to happen).
     *
     * @return null|string
     */
    public function getRankTitleAttribute(): ?string
    {
        $name = self::RANKS[$this->m_nMemberLv];

        return trans(sprintf("trans/guild_rank.%s", $name));
    }
}

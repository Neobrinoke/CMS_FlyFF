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
 * @property Carbon CreateTime
 * @property int m_nClass
 *
 * @property Guild guild
 * @property Character player
 */
class GuildMember extends Model
{
	/** @var string */
	protected $connection = 'character';

	/** @var string */
	protected $table = 'GUILD_MEMBER_TBL';

	/** @var array */
	protected $fillable = [
		'm_idPlayer',
		'serverindex',
		'm_idGuild',
		'm_szAlias',
		'm_nWin',
		'm_nLose',
		'm_nSurrender',
		'm_nMemberLv',
		'm_nGiveGold',
		'm_nGivePxp',
		'm_idWar',
		'm_idVote',
		'isuse',
		'CreateTime',
		'm_nClass'
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
}
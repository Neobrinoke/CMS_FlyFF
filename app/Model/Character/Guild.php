<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Guild
 * @package App\Model\Character
 *
 * @property string m_idGuild
 * @property string serverindex
 * @property int Lv_1
 * @property int Lv_2
 * @property int Lv_3
 * @property int Lv_4
 * @property int Pay_0
 * @property int Pay_1
 * @property int Pay_2
 * @property int Pay_3
 * @property int Pay_4
 * @property string m_szGuild
 * @property int m_nLevel
 * @property int m_nGuildGold
 * @property int m_nGuildPxp
 * @property int m_nWin
 * @property int m_nLose
 * @property int m_nSurrender
 * @property int m_nWinPoint
 * @property int m_dwLogo
 * @property string m_szNotice
 * @property string isuse
 * @property Carbon CreateTime
 *
 * @property Character leader
 * @property Collection members
 */
class Guild extends Model
{
	/** @var string */
	protected $primaryKey = 'm_idGuild';

	/** @var bool */
	public $incrementing = false;

	/** @var string */
	protected $connection = 'character';

	/** @var string */
	protected $table = 'GUILD_TBL';

	/** @var bool */
	public $timestamps = false;

	/** @var array */
	protected $dates = [
		'CreateTime'
	];


	/**
	 * Return all guilds order by specified column.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function getForRanking()
	{
		return self::query()->orderBy('m_nLevel', 'DESC')->orderBy('CreateTime', 'ASC');
	}

	/**
	 * Return members for this guild.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function members()
	{
		return $this->hasMany(GuildMember::class, 'm_idGuild', 'm_idGuild')
			->orderBy('m_nMemberLv')
			->orderBy('m_nClass', 'DESC')
			->orderBy('m_nGivePxp', 'DESC')
			->orderBy('m_nGiveGold', 'DESC')
			->orderBy('CreateTime');
	}

	/**
	 * Return leader for this guild.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function leader()
	{
		return $this->members()->where('m_nClass', '=', 0)->get()->first()->player();
	}

	public function hasLogo()
	{
		$this->m_dwLogo = 11;
		return (int)$this->m_dwLogo >= 1 && (int)$this->m_dwLogo <= 27;
	}

	/**
	 * Return formatted logo, or - if she doesn't have logo, for this guild.
	 *
	 * @return string
	 */
	public function getLogo()
	{
		if ($this->m_dwLogo < 10) {
			$this->m_dwLogo = '0' . $this->m_dwLogo;
		}
		return asset(sprintf("/img/guilds/Icon_CloakSLogo%d.jpg", $this->m_dwLogo));
	}

	/**
	 * Return max members count for this guild.
	 *
	 * @return \Illuminate\Config\Repository|mixed
	 */
	public function getMaxMembersCount()
	{
		return config(sprintf("resources.guild.maxMembersCount.%d", $this->m_nLevel));
	}
}

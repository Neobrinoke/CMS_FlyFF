<?php

namespace App\Model\Character;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GuildMember
 * @package App\Model\Character
 *
 * @property string serverindex
 * @property string m_idPlayer
 * @property int MultiServer
 *
 * @property Character player
 */
class MultiServerInfo extends Model
{
	/** @var string */
	protected $connection = 'character';

	/** @var string */
	protected $table = 'tblMultiServerInfo';

	/** @var bool */
	public $timestamps = false;

	/**
	 * Retrieve all connected players.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	public static function allConnected()
	{
		return self::query()->where('MultiServer', '>', 0)->get();
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
	public function isOnline(): bool
	{
		return $this->MultiServer > 0;
	}
}
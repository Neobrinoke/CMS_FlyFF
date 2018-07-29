<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lord
 * @package App\Model\Character
 *
 * @property int nServer
 * @property int idElection
 * @property int idLord
 * @property string formattedIdLord
 * @property Carbon s_date
 *
 * @property string lord_id
 *
 * @property Character player
 */
class Lord extends Model
{
    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'tblLord';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $casts = [
        'nServer' => 'int',
        'idElection' => 'int',
        'idLord' => 'int'
    ];

    /** @var array */
    protected $dates = [
        's_date'
    ];

    /**
     * Return current lord session.
     *
     * @return Lord|null
     */
    public static function getCurrent(): ?Lord
    {
        return self::query()->orderByDesc('s_date')->get()->first();
    }

    /**
     * Return player for this lord session.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function player()
    {
        return $this->hasOne(Character::class, 'm_idPlayer', 'lord_id');
    }

    /**
     * Return formatted idLord.
     *
     * @return string
     */
    public function getLordIdAttribute(): string
    {
        return substr('0000000', 0, 7 - strlen($this->idLord)) . $this->idLord;
    }
}

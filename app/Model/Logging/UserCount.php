<?php

namespace App\Model\Logging;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCount
 * @package App\Model\Logging
 *
 * @property string serverindex
 * @property int number
 * @property int m_01
 * @property int m_02
 * @property int m_03
 * @property int m_04
 * @property int m_05
 * @property int m_06
 * @property int m_07
 * @property int m_08
 * @property int m_09
 * @property int m_10
 * @property int m_11
 * @property int m_12
 * @property int m_13
 * @property int m_14
 * @property int m_15
 * @property int m_16
 * @property int m_17
 * @property int m_18
 * @property int m_19
 * @property int m_20
 * @property int m_channel
 * @property Carbon s_date
 */
class UserCount extends Model
{
    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $connection = 'logging';

    /** @var string */
    protected $table = 'LOG_USER_CNT_TBL';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $casts = [
        'number' => 'int',
        'm_01' => 'int',
        'm_02' => 'int',
        'm_03' => 'int',
        'm_04' => 'int',
        'm_05' => 'int',
        'm_06' => 'int',
        'm_07' => 'int',
        'm_08' => 'int',
        'm_09' => 'int',
        'm_10' => 'int',
        'm_11' => 'int',
        'm_12' => 'int',
        'm_13' => 'int',
        'm_14' => 'int',
        'm_15' => 'int',
        'm_16' => 'int',
        'm_17' => 'int',
        'm_18' => 'int',
        'm_19' => 'int',
        'm_20' => 'int',
        'm_channel' => 'int',
    ];

    /** @var array */
    protected $dates = [
        's_date',
    ];

    /**
     * Return instance of UserCount.
     *
     * @return UserCount|null
     */
    public static function find(): ?UserCount
    {
        return self::query()->orderByDesc('number')->first();
    }
}

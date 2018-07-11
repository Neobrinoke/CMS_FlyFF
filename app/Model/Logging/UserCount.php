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
    protected $dates = [
        's_date'
    ];

    /**
     * Return max connected number.
     *
     * @return int
     */
    public static function getMaxConnectedNumber(): int
    {
        /** @var self $userCount */
        $userCount = self::query()->orderByDesc('number')->first();

        return $userCount->number;
    }
}

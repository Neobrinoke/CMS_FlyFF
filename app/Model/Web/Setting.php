<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 * @package App\Model\Web
 *
 * @property int id
 * @property string exp_rate
 * @property string drop_rate
 * @property string penyas_rate
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Setting extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'exp_rate',
        'drop_rate',
        'penyas_rate'
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Return settings info.
     *
     * @return Setting
     */
    public static function getSettings(): Setting
    {
        return self::query()->firstOrCreate([]);
    }
}

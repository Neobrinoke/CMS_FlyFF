<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * @package App\Model\Web
 *
 * @property int id
 * @property int user_id
 * @property int action
 * @property string value
 * @property Carbon performed_at
 *
 * @property User user
 */
class Log extends Model
{
    public const ACTION_TYPE_BUY_SHOP = 1;
    public const ACTION_TYPE_PAYMENT = 2;
    public const ACTION_TYPE_LOGIN = 3;
    public const ACTION_TYPE_VOTE = 4;

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $fillable = [
        'user_id',
        'action',
        'value',
        'performed_at'
    ];

    /** @var array */
    protected $dates = [
        'performed_at'
    ];

    /**
     * Return user for this log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a log for buy shop action.
     *
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function buyShop($value): Model
    {
        return self::create(self::ACTION_TYPE_BUY_SHOP, $value);
    }

    /**
     * Create a log for given type & value.
     *
     * @param int $type
     * @param $value
     * @return Model
     */
    public static function create(int $type, $value): Model
    {
        return self::query()->create([
            'user_id' => auth()->id(),
            'action' => $type,
            'value' => serialize($value),
            'performed_at' => Carbon::now()
        ]);
    }
}

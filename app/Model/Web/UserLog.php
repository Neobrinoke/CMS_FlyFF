<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Log
 * @package App\Model\Web
 *
 * @property int id
 * @property int user_id
 * @property int action
 * @property string ip_address
 * @property string value_string
 * @property Carbon performed_at
 *
 * @property mixed value
 *
 * @property User user
 */
class UserLog extends Model
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
        'ip_address',
        'value_string',
        'performed_at',
    ];

    /** @var array */
    protected $casts = [
        'user_id' => 'int',
        'action' => 'int',
    ];

    /** @var array */
    protected $dates = [
        'performed_at',
    ];

    /**
     * Create a log for buy shop action.
     *
     * @param Request $request
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function buyShop(Request $request, $value): Model
    {
        return self::create($request, self::ACTION_TYPE_BUY_SHOP, $value);
    }

    /**
     * Create a log for buy shop action.
     *
     * @param Request $request
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function login(Request $request, $value): Model
    {
        return self::create($request, self::ACTION_TYPE_LOGIN, $value);
    }

    /**
     * Create a log for given type & value.
     *
     * @param Request $request
     * @param int $type
     * @param $value
     * @return Model
     */
    public static function create(Request $request, int $type, $value): Model
    {
        return self::query()->create([
            'user_id' => auth()->id(),
            'action' => $type,
            'ip_address' => $request->ip(),
            'value_string' => serialize($value),
            'performed_at' => Carbon::now(),
        ]);
    }

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
     * Return unserialized value.
     *
     * @return mixed
     */
    public function getValueAttribute()
    {
        return unserialize($this->value_string);
    }
}

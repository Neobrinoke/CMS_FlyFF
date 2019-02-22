<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Download
 * @package App\Model\Web
 *
 * @property int id
 * @property int author_id
 * @property int type
 * @property string size
 * @property string link
 * @property string image
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property bool is_updated
 */
class Download extends Model
{
    use SoftDeletes;

    public const TYPE_CLIENT = 1;
    public const TYPE_PATCHER = 2;

    /** @var array */
    protected $fillable = [
        'type',
        'size',
        'image',
        'link',
    ];

    /** @var array */
    protected $casts = [
        'author_id' => 'int',
        'type' => 'int',
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Return all download client type.
     *
     * @return Collection
     */
    public static function clients(): Collection
    {
        return self::query()->where('type', self::TYPE_CLIENT)->orderByDesc('created_at')->get();
    }

    /**
     * Return all download patcher type.
     *
     * @return Collection
     */
    public static function patchers(): Collection
    {
        return self::query()->where('type', self::TYPE_PATCHER)->orderByDesc('created_at')->get();
    }

    /**
     * Return true if this download has updated.
     *
     * @return bool
     */
    public function getIsUpdatedAttribute(): bool
    {
        return $this->created_at->notEqualTo($this->updated_at);
    }
}

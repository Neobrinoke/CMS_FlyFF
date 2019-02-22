<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Shop
 * @package App\Model\Web
 *
 * @property int id
 * @property string label
 * @property string|null image_thumbnail
 * @property bool is_active
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property string slug
 * @property string status
 *
 * @property Collection items
 */
class Shop extends Model
{
    use SoftDeletes;

    public const SALE_CS_TYPE = 1;
    public const SALE_VOTE_TYPE = 2;

    public const SALE_TYPES = [
        self::SALE_CS_TYPE,
        self::SALE_VOTE_TYPE
    ];

    public const SORT_LIST = [
        'price-asc',
        'price-desc',
        'title-asc',
        'title-desc'
    ];

    /** @var array */
    protected $fillable = [
        'label',
        'image_thumbnail',
        'is_active'
    ];

    /** @var array */
    protected $casts = [
        'is_active' => 'bool'
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Return all not empty shops.
     *
     * @param array $columns
     * @return Collection
     */
    public static function all($columns = ['*']): Collection
    {
        return self::query()->select($columns)->where('is_active', '=' , true)->whereHas('items')->get();
    }

    /**
     * Return all items for this shop.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(ShopItem::class);
    }

    /**
     * Return slug for this shop.
     *
     * @return string
     */
    public function getSlugAttribute(): string
    {
        return str_slug($this->label);
    }

    /**
     * Return status for this shop.
     *
     * @return string
     */
    public function getStatusAttribute(): string
    {
        return $this->is_active ? trans('admin/shop.index.table.statuses.on') : trans('admin/shop.index.table.statuses.off');
    }
}

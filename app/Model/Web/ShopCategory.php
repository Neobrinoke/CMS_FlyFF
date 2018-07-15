<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class ShopCategory
 * @package App\Model\Web
 *
 * @property int id
 * @property string label
 * @property string color
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property string slug
 *
 * @property Collection items
 */
class ShopCategory extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'label',
        'color'
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Return all items for this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(ShopItem::class);
    }

    /**
     * Return slug for this category.
     *
     * @return string
     */
    public function getSlugAttribute(): string
    {
        return str_slug($this->label);
    }
}

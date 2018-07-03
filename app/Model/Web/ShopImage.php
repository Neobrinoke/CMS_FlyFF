<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ShopImage
 * @package App\Model\Web
 *
 * @property int id
 * @property int item_id
 * @property string image
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property ShopItem item
 */
class ShopImage extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'item_id',
        'image'
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Return item for this image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(ShopItem::class);
    }
}

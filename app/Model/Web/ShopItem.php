<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class ShopItem
 * @package App\Model\Web
 *
 * @property int id
 * @property int category_id
 * @property int shop_id
 * @property int item_id
 * @property int sale_type
 * @property string title
 * @property string description
 * @property int price
 * @property string image_thumbnail
 * @property string slug
 * @property string sale_image
 * @property int quantity
 * @property int total_price
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property Shop shop
 * @property ShopCategory category
 * @property Collection images
 */
class ShopItem extends Model
{
	use SoftDeletes;

	const SALE_CS_TYPE = 1;
	const SALE_VOTE_TYPE = 2;

	/** @var array */
	protected $fillable = [
		'category_id',
		'shop_id',
		'item_id',
		'sale_type',
		'title',
		'description',
		'price',
		'image_thumbnail'
	];

	/** @var array */
	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at'
	];

	/**
	 * Return shop for this item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}

	/**
	 * Return category for this item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(ShopCategory::class);
	}

	/**
	 * Return all image for this item.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function images()
	{
		return $this->hasMany(ShopImage::class, 'item_id', 'id');
	}

	/**
	 * Return slug for this item.
	 *
	 * @return string
	 */
	public function getSlugAttribute(): string
	{
		return str_slug($this->title);
	}

	/**
	 * Return sale image for this item.
	 *
	 * @return string
	 */
	public function getSaleImageAttribute(): string
	{
		$type = intval($this->sale_type) === self::SALE_VOTE_TYPE ? 'vote' : 'cs';

		return asset(sprintf("/img/sale_%s_image.png", $type));
	}

	/**
	 * Return total price for this item.
	 *
	 * @return int
	 */
	public function getTotalPriceAttribute(): int
	{
		return $this->price * ($this->quantity ?? 1);
	}
}

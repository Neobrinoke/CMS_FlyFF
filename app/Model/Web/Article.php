<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 * @package App\Model\Web
 *
 * @property int id
 * @property string title
 * @property string content
 * @property int category_id
 * @property int author_id
 * @property string image_thumbnail
 * @property string image_header
 * @property ArticleCategory category
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property string detail_info
 * @property string slug
 * @property User author
 */
class Article extends Model
{
	use SoftDeletes;

	/** @var array */
	protected $fillable = [
		'title',
		'content',
		'category_id',
		'author_id',
		'image_thumbnail',
		'image_header',
	];

	/**
	 * Return author for this article.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function author()
	{
		return $this->hasOne(User::class, 'id', 'author_id');
	}

	/**
	 * Return category for this article.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(ArticleCategory::class);
	}

	/**
	 * Return creator name, date and time for this article.
	 *
	 * @return array|\Illuminate\Contracts\Translation\Translator|null|string
	 */
	public function getDetailInfoAttribute()
	{
		$name = $this->author->name;
		$date = Carbon::createFromTimeString($this->created_at)->format('d/m/Y');
		$time = Carbon::createFromTimeString($this->created_at)->toTimeString();
		return trans('site.article.detail', compact('name', 'date', 'time'));
	}

	/**
	 * Return slug for this article.
	 *
	 * @return string
	 */
	public function getSlugAttribute()
	{
		return str_slug($this->title);
	}
}

<?php

namespace App\Model\Web;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App\Model\Web
 *
 * @property int id
 * @property string title
 * @property string content
 * @property int category_id
 * @property int author_id
 *
 * @property User author
 */
class Article extends Model
{
	/** @var array */
	protected $fillable = [
		'title',
		'content',
		'category_id',
		'author_id',
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
}

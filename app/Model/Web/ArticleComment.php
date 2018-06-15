<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class ArticleComment
 * @package App\Model\Web
 *
 * @property int id
 * @property int author_id
 * @property string content
 * @property bool is_mine
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property Article article
 * @property User author
 */
class ArticleComment extends Model
{
	use SoftDeletes;

	/** @var array */
	protected $fillable = [
		'article_id',
		'author_id',
		'content'
	];

	/**
	 * Return article for this comment.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function article()
	{
		return $this->belongsTo(Article::class);
	}

	/**
	 * Return author for this comment.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'author_id', 'id');
	}

	/**
	 * Return true if this comment belongs to the current user.
	 *
	 * @return bool
	 */
	public function getIsMineAttribute(): bool
	{
		return intval($this->author_id) === Auth::id();
	}
}

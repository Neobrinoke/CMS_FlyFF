<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
 * @property bool authorized_comment
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property int comment_count
 * @property string detail_info
 * @property string slug
 *
 * @property User author
 * @property ArticleCategory category
 * @property Collection comments
 * @property Collection responses
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

    /** @var array */
    protected $casts = [
        'category_id' => 'int',
        'author_id' => 'int',
        'authorized_comment' => 'bool',
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
     * Return all comments for this article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(ArticleComment::class)->whereNull('comment_id')->orderByDesc('created_at');
    }

    /**
     * Return all responses for this article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses()
    {
        return $this->hasMany(ArticleComment::class)->whereNotNull('comment_id')->orderByDesc('created_at');
    }

    /**
     * Return all response and comment count for this article.
     *
     * @return int
     */
    public function getCommentCountAttribute(): int
    {
        return $this->comments->count() + $this->responses->count();
    }

    /**
     * Return creator name, date and time for this article.
     *
     * @return string
     */
    public function getDetailInfoAttribute(): string
    {
        return trans('article.detail', [
            'author' => $this->author->name,
            'created_at' => $this->created_at,
        ]);
    }

    /**
     * Return slug for this article.
     *
     * @return string
     */
    public function getSlugAttribute(): string
    {
        return str_slug($this->title);
    }
}

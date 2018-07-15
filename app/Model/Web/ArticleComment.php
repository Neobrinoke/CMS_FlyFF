<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use function PHPSTORM_META\type;

/**
 * Class ArticleComment
 * @package App\Model\Web
 *
 * @property int id
 * @property int article_id
 * @property int author_id
 * @property int|null comment_id
 * @property string content
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property bool is_mine
 * @property bool has_responses
 * @property bool is_response
 *
 * @property Article article
 * @property User author
 * @property ArticleComment|null parent
 * @property Collection responses
 */
class ArticleComment extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'article_id',
        'author_id',
        'comment_id',
        'content'
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /** @var array */
    protected $casts = [
        'author_id' => 'int'
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
     * Return parent for this response.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'id', 'comment_id');
    }

    /**
     * Return all response for this comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses()
    {
        return $this->hasMany(self::class, 'comment_id', 'id');
    }

    /**
     * Return true if this comment belongs to the current user.
     *
     * @return bool
     */
    public function getIsMineAttribute(): bool
    {
        return $this->author_id === Auth::id();
    }

    /**
     * Return true if responses exists for this comment.
     *
     * @return bool
     */
    public function getHasResponsesAttribute(): bool
    {
        return $this->responses->isNotEmpty();
    }

    /**
     * Return true if this comment is an response.
     *
     * @return bool
     */
    public function getIsResponseAttribute(): bool
    {
        return !is_null($this->parent);
    }

    /**
     * Force delete current comment and response for this comment.
     *
     * @return bool|null
     */
    public function forceDelete()
    {
        /** @var ArticleComment $response */
        foreach ($this->responses as $response) {
            $response->forceDelete();
        }

        return parent::forceDelete();
    }
}

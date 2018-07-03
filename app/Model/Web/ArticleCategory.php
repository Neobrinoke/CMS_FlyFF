<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class ArticleCategory
 * @package App\Model\Web
 *
 * @property int id
 * @property string label
 * @property string color
 * @property string slug
 * @property Collection articles
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class ArticleCategory extends Model
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
     * Return all articles for this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    /**
     * Return slug for this category.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return str_slug($this->label);
    }
}

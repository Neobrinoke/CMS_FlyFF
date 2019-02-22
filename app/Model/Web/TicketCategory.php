<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class TicketCategory
 * @package App\Model\Web
 *
 * @property int id
 * @property string name
 * @property string color
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property Collection tickets
 */
class TicketCategory extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'name',
        'color',
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Return all tickets for this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

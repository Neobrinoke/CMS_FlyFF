<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TicketAttachment
 * @package App\Model\Web
 *
 * @property int id
 * @property int ticket_id
 * @property int author_id
 * @property string name
 * @property string url
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class TicketAttachment extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'ticket_id',
        'author_id',
        'name',
        'url'
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Return ticket for this attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Return ticket for this attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}

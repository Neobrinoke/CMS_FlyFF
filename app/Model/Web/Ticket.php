<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Ticket
 * @package App\Model\Web
 *
 * @property int id
 * @property int author_id
 * @property int assigned_to
 * @property int category_id
 * @property string title
 * @property string content
 * @property int status
 * @property int read_status
 * @property Carbon closed_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property string status_label
 *
 * @property Collection attachments
 * @property Collection responses
 * @property TicketCategory category
 */
class Ticket extends Model
{
    use SoftDeletes;

    public const STATUS_OPEN = 1;
    public const STATUS_CLOSED = 2;
    public const STATUS_REJECTED = 3;
    public const STATUS_READ_BY_USER = 4;
    public const STATUS_READ_BY_STAFF = 5;
    public const STATUS_READ_BY_BOTH = 6;

    public const STATUSES = [
        self::STATUS_OPEN,
        self::STATUS_CLOSED,
        self::STATUS_REJECTED,
        self::STATUS_READ_BY_USER,
        self::STATUS_READ_BY_STAFF,
        self::STATUS_READ_BY_BOTH
    ];

    /** @var array */
    protected $fillable = [
        'author_id',
        'assigned_to',
        'category_id',
        'title',
        'content',
        'status'
    ];

    /** @var array */
    protected $dates = [
        'closed_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Return all attachments for this ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }

    /**
     * Return all responses for this ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    /**
     * Return category for this ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    /**
     * Return ticket for this ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Return status label for this ticket.
     *
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        return trans('trans/ticket.statuses.' . $this->status);
    }
}

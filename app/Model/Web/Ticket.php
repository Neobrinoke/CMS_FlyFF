<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property bool is_open
 * @property bool has_attachments
 * @property bool is_mine
 *
 * @property Collection attachments
 * @property Collection responses
 * @property TicketCategory category
 * @property User author
 */
class Ticket extends Model
{
    use SoftDeletes;

    public const UPLOAD_PATH = 'ticket/attachments';

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
    protected $casts = [
        'author_id' => 'int',
        'assigned_to' => 'int',
        'category_id' => 'int',
        'status' => 'int',
        'read_status' => 'int'
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
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class)->whereNull('response_id');
    }

    /**
     * Return all responses for this ticket.
     *
     * @return HasMany
     */
    public function responses(): HasMany
    {
        return $this->hasMany(TicketResponse::class)->orderBy('created_at');
    }

    /**
     * Return category for this ticket.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    /**
     * Return ticket for this ticket.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
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

    /**
     * Determine if this ticket is open.
     *
     * @return bool
     */
    public function getIsOpenAttribute(): bool
    {
        return !in_array($this->status, [
            self::STATUS_CLOSED,
            self::STATUS_REJECTED
        ]);
    }

    /**
     * Determine if this ticket has attachments.
     *
     * @return bool
     */
    public function getHasAttachmentsAttribute(): bool
    {
        if ($this->attachments->isEmpty()) {
            return false;
        }

        /** @var TicketAttachment $attachment */
        foreach ($this->attachments as $attachment) {
            if ($attachment->file_exists) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return true if is a ticket of current logged user.
     *
     * @return bool
     */
    public function getIsMineAttribute(): bool
    {
        return $this->author_id === (int)auth()->id();
    }
}

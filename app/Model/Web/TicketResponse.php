<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class TicketResponse
 * @package App\Model\Web
 *
 * @property int id
 * @property int ticket_id
 * @property int author_id
 * @property string content
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property bool has_attachments
 *
 * @property Ticket ticket
 * @property Collection attachments
 * @property User author
 */
class TicketResponse extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'ticket_id',
        'author_id',
        'content',
    ];

    /** @var array */
    protected $casts = [
        'ticket_id' => 'int',
        'author_id' => 'int',
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Return ticket for this response.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Return all attachments for this ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class, 'response_id', 'id');
    }

    /**
     * Return ticket for this response.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Determine if this response has attachments.
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
}

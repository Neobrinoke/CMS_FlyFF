<?php

namespace App\Model\Web;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Class TicketAttachment
 * @package App\Model\Web
 *
 * @property int id
 * @property int ticket_id
 * @property int response_id
 * @property int author_id
 * @property string name
 * @property string url
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 *
 * @property string download_url
 * @property bool file_exists
 *
 * @property Ticket ticket
 * @property TicketResponse response
 */
class TicketAttachment extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'ticket_id',
        'response_id',
        'name',
        'url',
    ];

    /** @var array */
    protected $casts = [
        'ticket_id' => 'int',
        'response_id' => 'int',
        'author_id' => 'int',
    ];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
     * Return response for this attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function response()
    {
        return $this->belongsTo(TicketResponse::class);
    }

    /**
     * Return complete url for this attachment.
     *
     * @return string
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('ticket.download', [$this->ticket, $this]);
    }

    /**
     * Determine if this attachment exists.
     *
     * @return bool
     */
    public function getFileExistsAttribute(): bool
    {
        return Storage::disk('local')->exists($this->url);
    }
}

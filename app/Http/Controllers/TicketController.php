<?php

namespace App\Http\Controllers;

use App\Model\Web\Ticket;
use App\Model\Web\TicketAttachment;
use App\Model\Web\TicketCategory;
use App\Model\Web\TicketResponse;
use App\Model\Web\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $categories = TicketCategory::all();
        $statuses = Ticket::STATUSES;

        $ticketQuery = $user->tickets()->orderByDesc('created_at');

        if ($request->input('title')) {
            $ticketQuery->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }

        $ticketQuery->whereBetween('created_at', [
            $request->input('creation_date_min') ?? Carbon::minValue()->toDateTimeString(),
            $request->input('creation_date_max') ?? Carbon::maxValue()->toDateTimeString()
        ]);

        if ($request->input('categories')) {
            $ticketQuery->whereIn('category_id', $request->input('categories'));
        }

        if ($request->input('statuses')) {
            $ticketQuery->whereIn('status', $request->input('statuses'));
        }

        $tickets = $ticketQuery->paginate(5);

        return view('ticket.index', [
            'categories' => $categories,
            'statuses' => $statuses,
            'tickets' => $tickets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = TicketCategory::all();

        return view('ticket.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|int',
            'title' => 'required|max:255',
            'content' => 'required|max:2000',
            'attachments.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // TODO: trouver un solution pour gérer tous les fichiers d'un coup sans le (.*)
        ]);

        $validatedData['author_id'] = auth()->id();
        $validatedData['status'] = Ticket::STATUS_OPEN;

        /** @var Ticket $ticket */
        $ticket = Ticket::query()->create($validatedData);

        if ($request->file('attachments')) {
            /** @var UploadedFile $attachment */
            foreach ($request->file('attachments') as $attachment) {
                $file = $attachment->store(Ticket::UPLOAD_PATH);

                TicketAttachment::query()->create([
                    'ticket_id' => $ticket->id,
                    'name' => $attachment->getClientOriginalName(),
                    'url' => $file
                ]);
            }
        }

        session()->flash('success', trans('trans/ticket.create.messages.success'));

        return redirect()->route('ticket.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return Response
     */
    public function storeResponse(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:2000',
            'attachments.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // TODO: trouver un solution pour gérer tous les fichiers d'un coup sans le (.*)
        ]);

        $validatedData['ticket_id'] = $ticket->id;
        $validatedData['author_id'] = auth()->id();

        /** @var TicketResponse $ticketResponse */
        $ticketResponse = TicketResponse::query()->create($validatedData);

        if ($request->file('attachments')) {
            /** @var UploadedFile $attachment */
            foreach ($request->file('attachments') as $attachment) {
                $file = $attachment->store(Ticket::UPLOAD_PATH);

                TicketAttachment::query()->create([
                    'ticket_id' => $ticket->id,
                    'response_id' => $ticketResponse->id,
                    'name' => $attachment->getClientOriginalName(),
                    'url' => $file
                ]);
            }
        }

        session()->flash('success', trans('trans/ticket.show.response.messages.success'));

        return redirect()->route('ticket.show', [$ticket]);
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->is_open && $ticket->status !== Ticket::STATUS_READ_BY_USER) {
            $ticket->status = Ticket::STATUS_READ_BY_USER;
            $ticket->save();
        }

        return view('ticket.show', [
            'ticket' => $ticket
        ]);
    }

    /**
     * Download given attachment.
     *
     * @param Ticket $ticket
     * @param TicketAttachment $ticketAttachment
     * @return Response
     */
    public function download(Ticket $ticket, TicketAttachment $ticketAttachment)
    {
        if (!$ticket->is_mine || !$ticketAttachment->file_exists) {
            abort(404);
        }

        return Storage::disk('local')->download($ticketAttachment->url, $ticketAttachment->name);
    }
}

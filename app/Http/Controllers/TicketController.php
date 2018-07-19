<?php

namespace App\Http\Controllers;

use App\Model\Web\Ticket;
use App\Model\Web\TicketAttachment;
use App\Model\Web\TicketCategory;
use App\Model\Web\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

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
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|int',
            'title' => 'required|max:255',
            'content' => 'required|max:2000',
            'attachments' => 'mimes:jpg,jpeg,png,bmp|max:20000|upload_count:5'
        ]);

        $validatedData['author_id'] = auth()->id();
        $validatedData['status'] = Ticket::STATUS_OPEN;

        /** @var Ticket $ticket */
        $ticket = Ticket::query()->create($validatedData);

        if ($request->file('attachments')) {
            /** @var UploadedFile $attachment */
            foreach ($request->file('attachments') as $attachment) {
                $file = $attachment->store('TicketAttachments');

                TicketAttachment::query()->create([
                    'ticket_id' => $ticket->id,
                    'author_id' => auth()->id(),
                    'name' => $attachment->getClientOriginalName(),
                    'url' => $file
                ]);
            }
        }

        session()->flash('success', trans('trans/ticket.create.messages.success'));

        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Web\Ticket $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Web\Ticket $ticket
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Web\Ticket $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Web\Ticket $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}

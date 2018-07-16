<?php

namespace App\Http\Controllers;

use App\Model\Web\Ticket;
use App\Model\Web\TicketCategory;
use App\Model\Web\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        $ticketQuery = $user->tickets();

        if ($request->input('title')) {
            $ticketQuery->where('title', 'LIKE', '%' . $request->input('title'). '%');
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|int',
            'content' => 'required|min:20'
        ]);

        dd($validatedData);
        // TODO: finir cette fonction
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Web\Ticket  $ticket
     * @return Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Web\Ticket  $ticket
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Web\Ticket  $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Web\Ticket  $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}

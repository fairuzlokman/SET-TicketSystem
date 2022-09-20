<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();

        return response()->json($tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket=Auth::user()->ticket()->create($request->all());

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        // $targetTicket = Ticket::findOrFail($ticket);
        $targetTicket = Auth::user()
            ->ticket()
            ->findOrFail($ticket->id)
            ->first();

        return new TicketResource($targetTicket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // $targetTicket = Ticket::findOrFail($ticket);
        
        // $targetTicket->update($request->all());
    
        // return tap($targetTicket)->update($request->all());
        
        if($ticket->user_id == Auth::id()){
            
            $this->authorize('update', $ticket);

            // $ticket->update($request->except([
            //     'title',
            //     'category_id'
            // ]));
        }

        return new TicketResource($ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        // Ticket::findOrFail($ticket)->delete();

        // return response(null, 204);

        if($ticket->user_id == Auth::id()){

            $ticket->delete();

            return response()->json(null, 204);
        }

        abort(403);
    }
}

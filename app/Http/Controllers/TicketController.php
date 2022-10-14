<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\User;
use Illuminate\Http\Request;
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
        $tickets = Auth::user()->ticket;

        if(Auth::user()->role->role == 'Support')
        {
            return TicketResource::collection($tickets);

        }
        // elseif (Auth::user()->role->role == 'Developer')
        // {
        //     if($tickets->user_id == Auth::id()){

        //         return TicketResource::collection($tickets);
        //     }
        // }
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
        if(Auth::user()->role->role == 'Support')
        {
            $ticket=Auth::user()->ticket()->create($request->all());
            
            return new TicketResource($ticket);
        } abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if($ticket->user_id == Auth::id()){

            $targetTicket = Auth::user()
                ->ticket()
                ->findOrFail($ticket->id)
                ->first();
    
            return new TicketResource($targetTicket);
        }
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
    public function update(UpdateTicketRequest $request, $ticket)
    {
        $targetTicket = Ticket::findOrFail($ticket);
        if(Auth::user()->role->role == "Support"){
            $targetTicket->update($request->all());
            return new TicketResource($targetTicket);

        } elseif (Auth::user()->role->role == "Developer"){
            $targetTicket->update($request->only([
                "status_id"
            ]));
            return new TicketResource($targetTicket);
        } abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if(Auth::user()->role->role == 'Support')    
        {
            $ticket->delete();

            return response()->json(null, 204);

        } abort(403);
    }
}

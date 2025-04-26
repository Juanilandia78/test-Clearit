<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Notifications\TicketStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketMessageController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->user_id = auth()->id(); // puede ser user o agente
        $message->message = $request->message;
        $message->save();

        if (auth()->user()->isAgent()) {
            $ticket->user->notify(new TicketStatusUpdated($ticket, 'New message added by the agent'));
        } else {

            $agents = User::where('role', 'agent')->get();
            foreach ($agents as $agent) {
                $agent->notify(new TicketStatusUpdated($ticket, 'New message added by the user'));
            }
        }

        return redirect()->back()->with('success', 'Message sent successfully.');
        }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,closed',
        ]);


        $ticket->status = $request->status;
        $ticket->save();


        $ticket->user->notify(new TicketStatusUpdated($ticket, $request->status));

        return redirect()->route('agent.tickets.show', $ticket)
                         ->with('success', 'Ticket status updated successfully.');
    }



}

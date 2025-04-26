<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Notifications\TicketStatusUpdated;
use Illuminate\Http\Request;

class AgentTicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::with('user')->latest()->paginate(10);

        return view('agent.dashboard', compact('tickets'));
    }


    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'attachments']);
        return view('agent.tickets.show', compact('ticket'));
    }


    public function update(Request $request, Ticket $ticket)
    {

        $request->validate([
            'status' => 'required|in:pending,in_progress,closed',
        ]);


        $ticket->status = $request->input('status');
        $ticket->save();

        $ticket->user->notify(new TicketStatusUpdated($ticket, 'Status changed to: ' . $ticket->status));


        return redirect()->route('agent.tickets.show', $ticket)->with('success', 'status updated.');
    }
}

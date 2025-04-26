<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\NewTicketCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTicketsController extends Controller
{

    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->paginate(10);

        return view('user.tickets.index', compact('tickets'));
    }


    public function create()
    {
        return view('user.tickets.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:1,2,3',
            'transport_mode' => 'required|in:air,land,sea',
            'product' => 'nullable|string|max:255',
            'origin_country' => 'nullable|string|max:255',
            'destination_country' => 'nullable|string|max:255',
            'attachments' => 'nullable|array|max:10',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'transport_mode' => $request->transport_mode,
            'product' => $request->product,
            'origin_country' => $request->origin_country,
            'destination_country' => $request->destination_country,
            'user_id' => Auth::id(),
        ]);


        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {

                $path = $attachment->store('attachments', 'public');


                $ticket->attachments()->create([
                    'path' => $path,
                    'original_name' => $attachment->getClientOriginalName(),
                ]);
            }
        }

        $agents = User::where('role', 'agent')->get();

        foreach ($agents as $agent) {
        $agent->notify(new NewTicketCreated($ticket));
            }

        return redirect()->route('user.tickets.index')->with('success', 'Ticket created successfully.');
    }


    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        return view('user.tickets.edit', compact('ticket'));
    }


    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:1,2,3',
            'transport_mode' => 'required|in:air,land,sea',
            'product' => 'nullable|string|max:255',
            'origin_country' => 'nullable|string|max:255',
            'destination_country' => 'nullable|string|max:255',
            'attachments' => 'nullable|array|max:10',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $ticket->update($request->only('title', 'description', 'type', 'transport_mode', 'product', 'origin_country', 'destination_country'));


    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $attachment) {

            $path = $attachment->store('attachments', 'public');


            $request->attachments()->create([
                'file_path' => $path,
                'original_name' => $attachment->getClientOriginalName(),
            ]);
        }
    }


        return redirect()->route('user.tickets.index')->with('success', 'Ticket updated.');
    }


    public function show(Ticket $ticket)
    {

        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'You do not have permission to view this ticket.');
        }

        return view('user.tickets.show', compact('ticket'));
    }



    public function destroy(Ticket $ticket)
    {


        $this->authorize('delete', $ticket);


        $ticket->delete();


        return redirect()->route('user.tickets.index')->with('success', 'Ticket deleted.');
    }
}

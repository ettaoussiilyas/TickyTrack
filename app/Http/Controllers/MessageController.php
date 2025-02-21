<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = auth()->user()->tickets()->latest()->get();
        $messages = collect();
        $currentTicket = null;

        if ($request->has('ticket')) {
            $currentTicket = Ticket::with(['messages.user'])->findOrFail($request->query('ticket'));

            // Add debugging line
            \Log::info('Loading messages for ticket: ' . $request->query('ticket'));

            $messages = $currentTicket->messages()
                ->with('user')
                ->orderBy('created_at')
                ->get();

            // Add debugging line
            \Log::info('Found messages: ' . $messages->count());
        }

        return view('user.messages', [
            'tickets' => $tickets,
            'messages' => $messages,
            'currentTicket' => $currentTicket
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'content' => 'required|string'
        ]);

        $ticket = Ticket::findOrFail($validated['ticket_id']);

        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        Message::create([
            'ticket_id' => $validated['ticket_id'],
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'is_agent_reply' => false
        ]);

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

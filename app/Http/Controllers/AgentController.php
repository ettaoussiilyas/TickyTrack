<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agent = auth()->user();

        // Get statistics
        $totalTickets = Ticket::where('agent_id', $agent->id)->count();
        $openTickets = Ticket::where('agent_id', $agent->id)
            ->where('status', 'open')
            ->count();
        $inProgressTickets = Ticket::where('agent_id', $agent->id)
            ->where('status', 'in_progress')
            ->count();
        $closedTickets = Ticket::where('agent_id', $agent->id)
            ->where('status', 'closed')
            ->count();

        // Get recent tickets
        $recentTickets = Ticket::where('agent_id', $agent->id)
            ->latest()
            ->take(5)
            ->get();

        return view('agent.dashboard', compact(
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'closedTickets',
            'recentTickets'
        ));
    }

    public function myTickets()
    {
        $tickets = Ticket::where('agent_id', auth()->id())
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('agent.tickets.mytickets', compact('tickets'));
    }

    public function messages()
    {
        $tickets = Ticket::where('agent_id', auth()->id())
            ->with(['messages', 'user'])
            ->latest()
            ->get();

        $messages = collect();
        $currentTicket = null;

        if (request()->has('ticket')) {
            $currentTicket = Ticket::with(['messages.user'])
                ->where('agent_id', auth()->id())
                ->findOrFail(request()->query('ticket'));

            $messages = $currentTicket->messages()
                ->with('user')
                ->orderBy('created_at')
                ->get();
        }

        return view('agent.messages', compact('tickets', 'messages', 'currentTicket'));
    }
    public function edit(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated agent
        if ($ticket->agent_id !== auth()->id()) {
            abort(403);
        }

        return view('agent.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated agent
        if ($ticket->agent_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,in_progress,resolved'],
        ]);

        $ticket->update($validated);

        return redirect()->route('agent.tickets.mytickets')
            ->with('success', 'Ticket status updated successfully.');
    }
}

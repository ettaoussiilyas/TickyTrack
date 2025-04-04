<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));

    }

//    public function allTickets(){
//        $tickets = Ticket::latest()->paginate(10);
//        return view('admin.tickets.index', compact('tickets'));
//    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tickets.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in_progress,closed',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        Ticket::create($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $agents = User::where('role', 'agent')->get();
        return view('admin.tickets.edit', compact('ticket', 'agents'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Add this line temporarily to see what data is being received
        // dd($request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'agent_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,in_progress,resolved'
        ]);

        try {
            $ticket->update($validated);
            return redirect()->route('admin.tickets.index')
                ->with('success', 'Ticket updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to update ticket: ' . $e->getMessage());
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket deleted successfully');
    }

}

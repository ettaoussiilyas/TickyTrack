<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//        return view('user.dashboard');
//    }

    public function index()
    {
        // Get total tickets for the authenticated user
        $totalTickets = auth()->user()->tickets()->count();

        // Get recent tickets for the authenticated user
        $recentTickets = auth()->user()->tickets()
            ->latest()
            ->take(10)
            ->with(['assignedTo']) // Eager load relationships if needed
            ->get();

        return view('user.dashboard', compact('totalTickets', 'recentTickets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = auth()->user()->tickets()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'open', // Default status
        ]);

        return redirect()->route('user.tickets.show', $ticket)
            ->with('success', 'Ticket created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // Ensure the user can only view their own tickets
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.tickets.show', compact('ticket'));
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

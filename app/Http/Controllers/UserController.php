<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Prevent updating own role
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'You cannot change your own role'], 403);
        }

        $validated = $request->validate([
            'role' => 'required|in:user,agent,admin'
        ]);

        try {
            $user->update(['role' => $validated['role']]);
            return response()->json([
                'message' => 'Role updated successfully',
                'success' => true
            ]);
        } catch (\Exception $e) {
            \Log::error('Role update failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update role',
                'success' => false
            ], 500);
        }
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
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'Cannot delete yourself'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

}

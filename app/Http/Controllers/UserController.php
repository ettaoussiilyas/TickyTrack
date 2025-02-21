<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public function dashboardUser()
    {
        $user = auth()->user();

        $data = [
            'totalTickets' => $user->tickets()->count(),
            'openTickets' => $user->tickets()->where('status', 'open')->count(),
            'resolvedTickets' => $user->tickets()->where('status', 'resolved')->count(),
            'recentTickets' => $user->tickets()->latest()->take(5)->get(),
        ];

        return view('user.dashboard', $data);
    }

    public function updateRole(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role');
        }

        $validated = $request->validate([
            'role' => 'required|in:user,agent,admin'
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'Role updated successfully');
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

    public function tickets()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.tickets.index', compact('tickets'));
    }


    public function createTicket(): View
    {
        $categories = Category::all();
        return view('user.tickets.create', compact('categories'));
    }

    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ticket = Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('user.tickets.index')
            ->with('success', 'Ticket created successfully.');
    }



//    public function showTicket($ticket): View
//    {
//        $ticket = auth()->user()->tickets()->findOrFail($ticket);
//        return view('user.tickets.show', compact('ticket'));
//    }

    public function showTicket(Ticket $ticket)
    {
        // Ensure the user can only view their own tickets
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.tickets.show', compact('ticket'));
    }




}

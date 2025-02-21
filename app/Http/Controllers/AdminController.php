<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recentTickets = Ticket::latest()->take(7)->get();
        $totalTickets = Ticket::count();

        return view('admin.dashboard', compact('recentTickets', 'totalTickets'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $modelName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $modelName)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $modelName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $modelName)
    {
        //
    }


    public function statistics()
    {
        $statistics = [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_agents' => User::where('role', 'agent')->count(),
            'total_regular_users' => User::where('role', 'user')->count(),
            'total_tickets' => Ticket::count(),
            'open_tickets' => Ticket::where('status', 'open')->count(),
            'closed_tickets' => Ticket::where('status', 'closed')->count(),
            'in_progress_tickets' => Ticket::where('status', 'in_progress')->count(),
        ];

        return view('admin.statistics', compact('statistics'));
    }
}

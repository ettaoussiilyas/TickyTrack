<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ticket;
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
}

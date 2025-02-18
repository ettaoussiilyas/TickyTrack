<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $agents = User::where('role', 'agent')->get();
        $categories = Category::all();

        for($i = 0; $i < 10; $i++){

            Ticket::create([
                'title' => 'SamppleTicket' . ($i + 1),
                'description' => 'This is a Sample Description for a Simple Ticket',
                'status' => ['pending', 'in_progress', 'resolved'][rand(0, 2)],
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'agent_id' => $agents->random()->id
            ]);
        }
    }
}

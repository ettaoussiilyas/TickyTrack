<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = Ticket::all();
        $users = User::all();

        foreach ($tickets as $ticket) {

            for ($i = 0; $i < rand(2, 3); $i++){

                Message::create([
                    'content' => 'Sample message' . ($i + 1) . ' for ticket ' . $ticket->id,
                    'ticket_id' => $ticket->id,
                    'user_id' => $users->random()->id,
                ]);
            }
        }
    }
}

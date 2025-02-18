<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = Ticket::all();
        $users = User::all();

        foreach ($users as $user) {

            for($i = 0; $i < rand(2, 3); $i++) {
                Notification::create([
                    'message' => 'Sample notification ' . ($i + 1) . ' for user',
                    'is_read' => rand(0, 1) === 1,
                    'user_id' => $user->id,
                    'ticket_id' => $tickets->random()->id,
                ]);
            }

        }
    }
}

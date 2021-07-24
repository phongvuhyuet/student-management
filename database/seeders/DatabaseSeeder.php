<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $courses = \App\Models\Course::factory(10)->create();
        User::factory(2)->hasAttached($courses)
            ->has(
                \App\Models\Task::factory()->count(10),
                'tasksCreated'
            )
            ->has(\App\Models\Task::factory()->count(10), 'tasksReceived')
            ->has(\App\Models\Message::factory()->count(10), 'messagesCreated')
            ->has(\App\Models\Message::factory()->count(10), 'messagesReceived')
            ->create();
    }
}

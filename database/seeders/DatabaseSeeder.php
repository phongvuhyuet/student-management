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
        User::create(
            [
                'name' => '$this->faker->name()',
                'email' => 'a@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('phong'), // password
                'remember_token' => "abcdedasdd",
                'date_of_birth' => '2021/12/31',
                'role_id' => 1,
                'faculty' => 'CNTT',
                'class' => 'CJ',
                'so_lan_nhac_nho' => null,
                'thieu_hoc_phi' => null

            ]
        );
    }
}

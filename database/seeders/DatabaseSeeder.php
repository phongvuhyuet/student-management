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
        $class = \App\Models\Classes::factory()->create();
        $tasks = \App\Models\Task::factory(10)->create();

        User::factory(10)->hasAttached($courses, [
            'gk' => random_int(0, 10),
            'ck' => random_int(0, 10),
        ])
            ->for($class, 'class')
            ->create();
        $user1 = User::create(
            [
                'name'              => '$this->faker->name()',
                'email'             => 'a@gmail.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('phong'), // password
                'remember_token' => "abcdedasdd",
                'date_of_birth'     => '2021/12/31',
                'role_id'           => 1,
                'class_id'          => $class->id,
                'so_lan_nhac_nho'   => null,
                'msv'               => 19020392,
            ]
        );
        $class->update([
            'consultant_id' => $user1->id,
        ]);
        $class2 = \App\Models\Classes::factory()->create([
            'consultant_id' => $user1->id,
        ]);
        User::factory(10)->hasAttached($courses, [
            'gk' => random_int(0, 10),
            'ck' => random_int(0, 10),
        ])
            ->for($class2, 'class')
            ->create();
    }
}

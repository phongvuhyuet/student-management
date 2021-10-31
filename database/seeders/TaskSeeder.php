<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = User::find(100001)->consult->pluck('id');
        $uses = User::whereIn('class_id', $classes)->get();
        Task::factory(100000)->create([
            'creator_id' => 100001,
            'receiver_id' => $uses->random(),
        ]);
    }
}

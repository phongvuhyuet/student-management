<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // number of class = number of consultant * 2
    public const NUMBER_OF_TASK = 10000;
    public const NUMBER_OF_STUDENT = 10000;
    public const NUMBER_OF_CONSULTANT = 125;
    public const NUMBER_OF_CLASS = 250;
    public const NUMBER_OF_COURSE = 30;
    public const NUMBER_OF_MESSAGE = 10000;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $classes = \App\Models\Classes::factory(self::NUMBER_OF_CLASS)->create();
        $students = User::factory(self::NUMBER_OF_STUDENT)
            ->create();
        $consultants = User::factory(self::NUMBER_OF_CONSULTANT)
            ->create([
                'role_id' => 1,
                'so_lan_nhac_nho' => null,
                'diem_chuyen_can' => null,
                'hoan_canh' => null,
            ]);
        $consultants->each(function ($consultant, $key) {
            $classes = Classes::where('id', '>', $key * 2);
            $classes->each(function ($class) use ($consultant) {
                $class->update([
                    'consultant_id' => $consultant->id,
                ]);
            });
        });
        $courses = \App\Models\Course::factory(self::NUMBER_OF_COURSE)->create();
        $students->each(function ($student) use ($classes, $courses) {
            $student->update([
                'class_id' => $classes->random()->id,
            ]);
            $student->courses()->attach($courses->random(20), [
                'gk' => 1,
                'ck' => 1,
                'is_dong_hoc' => 1,
            ]);
        });
        // Attend::all()->each(function ($attend) {
        //     $attend->update([
        //         'gk' => rand(0, 10),
        //         'ck' => rand(0, 10),
        //         'is_dong_hoc' => rand(0, 1),
        //     ]);
        // });

        foreach ($courses as $course) {
            foreach ($course->users as $user) {
                $user->pivot->gk = rand(0, 10);
                $user->pivot->ck = rand(0, 10);
                $user->pivot->is_dong_hoc = rand(0, 1);
                $user->pivot->save();
            }
        }

        $tasks = \App\Models\Task::factory(self::NUMBER_OF_TASK)->create();
        $tasks->each(function ($task) use ($consultants) {

            $creator = $consultants->random();
            $task->update([
                'creator_id' => $creator->id,
                'receiver_id' => User::where('role_id', 2)
                    ->whereIn('class_id', Classes::where('consultant_id', $creator->id)->pluck('id'))
                    ->get()->random()->id,
            ]);
        });
        $messages = \App\Models\Message::factory(self::NUMBER_OF_MESSAGE)->create();
        $messages->each(function ($message) {
            $message->update([
                'user_id' => User::all()->random()->id,
            ]);
            if ($message->user->role_id == 1) {
                $message->update([
                    'receiver_id' => User::where('role_id', 2)
                        ->whereIn('class_id', Classes::where('consultant_id', $message->user->id)->pluck('id'))
                        ->get()->random()->id,
                ]);
            } else {
                $message->update([
                    'receiver_id' => User::where('role_id', 1)
                        ->whereHas('consult', function ($query) use ($message) {
                            $query->where('classes.id', $message->user->class_id);
                        })->get()->random()->id,
                ]);
            }
        });
    }
}

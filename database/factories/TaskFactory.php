<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['new', 'doing', 'done']),
            'deadline' => now(),
            'name' => $this->faker->name(),
            'progress' => $this->faker->numberBetween(0, 100),
            'detail' => $this->faker->sentence(),
            'receiver_id' => 1,
            'creator_id' => 1,
        ];
    }
}

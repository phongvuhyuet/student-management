<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ClassesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'faculty' => $this->faker->randomElement(['Công nghệ thông tin', 'Kỹ thuật máy tính', 'Công nghệ nông nghiệm', 'Cơ điện tử', 'Công nghệ sinh học']),
            'consultant_id' => null
        ];
    }
}

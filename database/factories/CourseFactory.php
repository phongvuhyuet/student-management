<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name();
        return [
            'name' => $name,
            'so_TC' => $this->faker->numberBetween(1, 5),
            'year' => $this->faker->numberBetween(2016, 2022),
            'term' => $this->faker->numberBetween(1, 3),
            'maMH' => preg_replace('/\s/', '_', $name) . '_' . $this->faker->unique()->numberBetween(1, 1000)
        ];
    }
}

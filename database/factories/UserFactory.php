<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $role_id = $this->faker->numberBetween(1, 2);
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'date_of_birth'     => $this->faker->date(),
            'role_id'           => $role_id,
            'so_lan_nhac_nho'   => ($role_id == 1) ? null : $this->faker->numberBetween(0, 4),
            'diem_chuyen_can'   => ($role_id == 1) ? null : $this->faker->numberBetween(50, 100),
            'hoan_canh'         => ($role_id == 1) ? null : $this->faker->randomElement([null, 'Hộ nghèo', 'Con thương binh', 'Sinh viên nghèo vượt khó']),
            'class_id'          => Classes::factory(),
            'msv'               => $this->faker->unique()->numberBetween(100000, 199999),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (!Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name . '\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $fecha_minima = strtotime('1983-01-01');
        $fecha_maxima = strtotime('2002-12-31');
        $carnet = sprintf("%04d%04d", fake()->numberBetween(1000, 9999), fake()->numberBetween(1000, 9999));
        return [
            'name' => $this->faker->firstname()." ".$this->faker->firstname(),
            'paterno' => $this->faker->lastname(),
            'materno' => $this->faker->lastname(),
            'carnet' => $carnet,
            'nacimiento' => $this->faker->date('Y-m-d', $this->faker->numberBetween($fecha_minima, $fecha_maxima)),
            'telefono' => sprintf("%04d%04d", fake()->numberBetween(1000, 9999), fake()->numberBetween(1000, 9999)),
            'imagen' => 'avatar.jpg',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => sha1($carnet), // password
            'remember_token' => Str::random(10),
            'estado' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

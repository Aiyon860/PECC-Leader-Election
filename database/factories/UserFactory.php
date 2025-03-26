<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nim' => $this->faker->unique()->numerify('##########'), // Generate a 10-digit NIM
            'password' => Hash::make('password'), // Default password, should be changed
            'status' => $this->faker->randomElement(['Sudah', 'Belum']),
            'remember_token' => Str::random(10),
        ];
        
    }

    /**
     * Indicate that the user has voted.
     *
     * @return static
     */
    public function hasVoted()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Sudah',
        ]);
    }

    /**
     * Indicate that the user has not voted.
     *
     * @return static
     */
    public function hasNotVoted()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Belum',
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function(User $user) {
            $role = Role::where('name', 'voter')->first();
            if ($role) {
                $user->assignRole($role);
            }
        });
    }
    
}
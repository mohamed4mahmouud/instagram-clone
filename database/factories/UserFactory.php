<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
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
            'fullName' => fake()->name(),
            'userName' => fake()->unique()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone'=>fake()->phoneNumber(),
            'gender'=>fake()->randomElement(['male','female','other'])
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
    public function configure()
{
    return $this->afterCreating(function (User $user) {
        $user->profile()->create(Profile::factory()->make()->toArray());
        $followersCount = mt_rand(1,100);
        $userstofollow = User::inRandomOrder()->limit($followersCount)->get();
        $userstofollow->each(function(User $follower) use ($user) {
            $user->followers()->attach($follower);
        });

    });
}
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bio'=>fake()->sentence(),
            'website'=>fake()->url(),
            'avatar'=>"avatar/sOpxT2VApuv9x7DQOhnT7UCagZrwbMgWYYfAylrc.jpg",
        ];
    }
}

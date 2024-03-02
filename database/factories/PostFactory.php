<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userByRandom = User::all()->random();
        return [
            // 'title'=>fake()->title(),
            'caption'=>fake()->sentence(),
            // 'enabled'=>fake()->boolean(70),
            // 'slug' => Str::slug($this->faker->title),
            'user_id'=>$userByRandom->id,
            'images'=>json_encode(['images/2MogqfapxvioWkUdfs7LV8MkSlUetCuvSskp99eX.webp'])
        ];
    }
}

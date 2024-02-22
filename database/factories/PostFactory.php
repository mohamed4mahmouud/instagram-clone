<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


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
            'caption'=>fake()->paragraph(),
            'images'=>fake()->image('public/storage/images',640,480,null,false)
        ];
    }
}

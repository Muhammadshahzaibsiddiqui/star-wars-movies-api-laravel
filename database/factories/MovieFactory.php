<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'             => fake()->name(),
            'episode_id'        => fake()->randomDigit(),
            'opening_crawl'     => fake()->name(),
            'director'          => fake()->name(),
            'producer'          => fake()->name(),
            'release_date'      => now(),
            'url'               => fake()->url(),
            'movie_created_at'  => now(),
            'movie_edited_at'   => now(),
            'adult'             => fake()->url(),
            'backdrop_path'     => fake()->url(),
            'language'          => fake()->languageCode(),
            'popularity'        => fake()->cityName(),
            'poster_path'       => fake()->url(),
            'video'             => fake()->url(),
            'vote_average'      => fake()->url(),
            'vote_count'        => fake()->randomDigit()
        ];
    }
}

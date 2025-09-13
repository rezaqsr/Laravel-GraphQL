<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        $year = $faker->year;
        return [
            'name' => $faker->movie . " ($year)",
            'director_id' => rand(1,8),
            'overview' => $faker->overview,
            'budget' => $this->faker->randomNumber(6),
            'boxOffice' => $this->faker->randomNumber(7),
            'year' => $year,
            'country' => $this->faker->country,

        ];
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Director::factory(8)->create();
        Genre::factory(4)->create();
        Movie::factory(20)->create()->each(function($movie) {
        $randomGenres = Genre::all()->random(rand(1,2))->pluck('id');
        $movie->genres()->attach($randomGenres);
    });
    }
}

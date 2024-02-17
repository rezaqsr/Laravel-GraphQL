<?php
namespace App\GraphQL\Mutation;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class NewMovieMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewMovie',
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'director' => [
                'name' => 'director',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Director of the movie',
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the movie',
            ],
            'overview' => [
                'name' => 'overview',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Overview of the movie',
            ],
            'budget' => [
                'name' => 'budget',
                'type' => Type::nonNull(Type::int()),
                'description' => 'Budget of the movie',
            ],
            'boxOffice' => [
                'name' => 'boxOffice',
                'type' => Type::nonNull(Type::int()),
                'description' => 'Box office of the movie',
            ],
            'year' => [
                'name' => 'year',
                'type' => Type::nonNull(Type::int()),
                'description' => 'Year of the movie',
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Country of the movie',
            ],
            'genres' => [
                'name' => 'genres',
                'type' => Type::listOf(Type::string()),
                'description' => 'Genres of the movie',
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    public function resolve($root, $args)
    {
        $rules = [
            'name' => [Rule::unique('movies')->ignore($args['id'] ?? null),],
        ];
        $validator = Validator::make($args, $rules);
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        $movie = new Movie();
        $director = Director::where('name', $args['director'])->first();

        if (!$director) {
            $director = new Director();
            $director->name = $args['director'];
            $director->save();
        }
        $movie->director_id = $director->id;
        $movie->name = $args['name'];
        $movie->overview = $args['overview'];
        $movie->budget = $args['budget'];
        $movie->boxOffice = $args['boxOffice'];
        $movie->year = $args['year'];
        $movie->country = $args['country'];
        $movie->save();

        if (isset($args['genres'])) {
            $genreIds = [];
            foreach ($args['genres'] as $genreName) {
                $genre = Genre::where('name', $genreName)->first();
                if (!$genre) {
                    $genre = new Genre();
                    $genre->name = $genreName;
                    $genre->save();
                }
                $genreIds[] = $genre->id;
            }
            $movie->genres()->sync($genreIds);
        }

        return "movie (name : $movie->name) created successfully";
    }
}

<?php

namespace App\GraphQL\Mutation;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class NewMovieMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewMovie',
        'description' => 'Create a new movie'
    ];

    public function type(): Type
    {
        return GraphQL::type('Movie');
    }

    public function args(): array
    {
        return [
            'director' => [
                'name' => 'director',
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of an existing director',
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'overview' => [
                'name' => 'overview',
                'type' => Type::nonNull(Type::string()),
            ],
            'budget' => [
                'name' => 'budget',
                'type' => Type::nonNull(Type::int()),
            ],
            'boxOffice' => [
                'name' => 'boxOffice',
                'type' => Type::nonNull(Type::int()),
            ],
            'year' => [
                'name' => 'year',
                'type' => Type::nonNull(Type::int()),
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::nonNull(Type::string()),
            ],
            'genres' => [
                'name' => 'genres',
                'type' => Type::nonNull(Type::listOf(Type::string())),
                'description' => 'List of existing genres',
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    public function resolve($root, $args)
    {

        $rules = [
            'name' => ['required', Rule::unique('movies')],
            'director' => ['required', 'string', 'exists:directors,name'],
            'overview' => ['required', 'string'],
            'budget' => ['required', 'integer'],
            'boxOffice' => ['required', 'integer'],
            'year' => ['required', 'integer'],
            'country' => ['required', 'string'],
            'genres' => ['required', 'array', 'min:1'],
            'genres.*' => ['required', 'string', 'exists:genres,name'],
        ];

        $validator = Validator::make($args, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $director = Director::where('name', $args['director'])->first();
        $movie = Movie::create([
            'name' => $args['name'],
            'overview' => $args['overview'],
            'budget' => $args['budget'],
            'boxOffice' => $args['boxOffice'],
            'year' => $args['year'],
            'country' => $args['country'],
            'director_id' => $director->id,
        ]);

        $genreIds = Genre::whereIn('name', $args['genres'])->pluck('id')->toArray();
        $movie->genres()->sync($genreIds);

        return $movie->load('director', 'genres');
    }
}

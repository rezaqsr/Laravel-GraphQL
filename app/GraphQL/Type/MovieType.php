<?php

namespace App\GraphQL\Type;

use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
class MovieType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Movie',
        'description' => 'Collection of movies',
        'model' => Movie::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the movie'
            ],
            'director' => [
                'type' => GraphQL::type('Director'),
                'description' => 'director of the movie'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Title of the movie'
            ],
            'overview' => [
                'type' => Type::string(),
                'description' => 'overview of the movie'
            ],
            'budget' => [
                'type' => Type::int(),
                'description' => 'budget of the movie'
            ],
            'boxOffice' => [
                'type' => Type::int(),
                'description' => 'boxOffice of the movie'
            ],
            'year' => [
                'type' => Type::int(),
                'description' => 'year of the movie'
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'country of the movie'
            ],
            'genres' => [
                'type' => Type::listOf(GraphQL::type('Genre')),
                'description' => 'Genres of the movie',
            ],
        ];
    }
}

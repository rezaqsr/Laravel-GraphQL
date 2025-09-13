<?php

namespace App\GraphQL\Type;


use App\Models\Genre;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class GenreType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Genre',
        'description' => 'Genres of movies',
        'model' => Genre::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'ID of the genre'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'name of genres'
            ],
            'movies' => [
                'type' => Type::listOf(GraphQL::type('Movie')),
                'description' => 'list Of Movies',
            ],
        ];
    }
}

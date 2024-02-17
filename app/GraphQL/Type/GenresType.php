<?php

namespace App\GraphQL\Type;


use App\Models\Genre;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class GenresType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Genres',
        'description' => 'Genres of movies',
        'model' => Genre::class
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => ''
            ],
            'movies' => [
                'type' => Type::listOf(GraphQL::type('Movies')),
                'description' => '',
            ],
        ];
    }
}

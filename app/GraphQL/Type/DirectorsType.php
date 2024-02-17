<?php

namespace App\GraphQL\Type;

use App\Models\Director;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class DirectorsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Directors',
        'description' => 'movies of Director',
        'model' => Director::class
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'Title of the Director'
            ],
            'movies' => [
                'type' => Type::listOf(GraphQL::type('Movies')),
                'description' => 'movies of the Director',
            ],
        ];
    }
}

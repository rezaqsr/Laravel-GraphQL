<?php

namespace App\GraphQL\Type;

use App\Models\Director;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class DirectorType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Director',
        'description' => 'movies of Director',
        'model' => Director::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'ID of the director'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Title of the Director'
            ],
            'movies' => [
                'type' => Type::listOf(GraphQL::type('Movie')),
                'description' => 'movies of the Director',
            ],
        ];
    }
}

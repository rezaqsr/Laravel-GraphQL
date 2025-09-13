<?php


namespace App\GraphQL\Query;

use App\Models\Director;
use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class DirectorsQuery extends Query
{
    protected $attributes = [
        'name' => 'directors',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Director'));
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, $args): array
    {
        $query = Director::query();

        if (isset($args['name'])) {
            $query->where('name', $args['name']);

        }
        return $query->with(['movies.genres'])->get()->toArray();
    }
}

<?php


namespace App\GraphQL\Query;


use App\Models\Genre;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class GenresQuery extends Query
{
    protected $attributes = [
        'name' => 'genres',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Genre'));
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

    public function resolve($root, $args): ?array
    {
        $query = Genre::query();

        if (isset($args['name'])) {
                $query->where('name', $args['name']);
        }


        return $query->with('movies.director')->get()->toArray();
    }
}

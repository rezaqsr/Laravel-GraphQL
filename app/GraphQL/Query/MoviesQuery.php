<?php


namespace App\GraphQL\Query;

use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class MoviesQuery extends Query
{
    protected $attributes = [
        'name' => 'movies',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Movies'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'year' => [
                'name' => 'year',
                'type' => Type::int(),
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args): ?array
    {
        $query = Movie::query();

        if (isset($args['name'])) {
                $query->where('name', $args['name']) ?? null;
        }
        if (isset($args['year'])) {
                $query->where('year', $args['year']) ?? null;
        }
        if (isset($args['country'])) {
                $query->where('country', $args['country']) ?? null;
        }

        return $query->get()->map(function ($movie) {
            return [
                'id' => $movie->id,
                'name' => $movie->name,
                'director' => $movie->director->name,
                'overview' => $movie->overview,
                'budget' => $movie->budget,
                'boxOffice' => $movie->boxOffice,
                'year' => $movie->year,
                'country' => $movie->country,
                'genres' => $movie->genres->pluck('name')->toArray(),
            ];
        })->toArray();
    }
}

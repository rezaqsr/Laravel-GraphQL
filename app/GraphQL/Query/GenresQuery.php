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
        return Type::listOf(GraphQL::type('Genres'));
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
                $query->where('name', $args['name']) ?? null;
        }


        return $query->get()->map(function ($genre) {
            return [
                'name' => $genre->name,
                'movies' => $genre->movies->map(function ($movie) {
                    return [
                        'name' => $movie->name,
                        'director' => $movie->director->name,
                        'overview' => $movie->overview,
                        'budget' => $movie->budget,
                        'boxOffice' => $movie->boxOffice,
                        'year' => $movie->year,
                        'country' => $movie->country,
                        'genres' => $movie->genres->pluck('name')->toArray(),
                    ];
                })->toArray(),
            ];
        })->toArray();
    }
}

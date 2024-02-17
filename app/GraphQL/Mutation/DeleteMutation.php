<?php
namespace App\GraphQL\Mutation;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'DeleteMovie'
    ];
    public function type(): Type
    {
        return Type::string();
    }
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $movie = Movie::find($args['id']);
        if (!$movie) {
            return null;
        }
        $movie->delete();
        return "Movie deleted successfully";
    }
}

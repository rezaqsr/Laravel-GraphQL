<?php
namespace App\GraphQL\Mutation;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateMovieMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateMovie'
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
            'director' => [
                'name' => 'director',
                'type' => Type::string(),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'overview' => [
                'name' => 'overview',
                'type' => Type::string(),
            ],
            'budget' => [
                'name' => 'budget',
                'type' => Type::int(),
            ],
            'boxOffice' => [
                'name' => 'boxOffice',
                'type' => Type::int(),
            ],
            'year' => [
                'name' => 'year',
                'type' => Type::int(),
            ],
            'country' => [
                'name' => 'country',
                'type' => Type::string(),
            ],
            'genres' => [
                'name' => 'genres',
                'type' => Type::listOf(Type::string()),
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $movie = Movie::find($args['id']);
        if (!$movie) {
            return null;
        }
        foreach ($args as $key => $value) {
            if ($key !== 'id' && $key !== 'genres' && $key !== 'director') {
                $movie->$key = $value;
            }
        }
        if (isset($args['director'])){
            $director = Director::where('name', $args['director'])->first();
            if (!$director) {
                $director = new Director();
                $director->name = $args['director'];
                $director->save();
            }
        }
        $movie->save();

        if (isset($args['genres'])) {
            $genreIds = [];
            foreach ($args['genres'] as $genreName) {
                $genre = Genre::where('name', $genreName)->first();
                if (!$genre) {
                    $genre = new Genre();
                    $genre->name = $genreName;
                    $genre->save();
                }
                $genreIds[] = $genre->id;
            }
            $movie->genres()->sync($genreIds);
        }

        return "movie (id : $movie->id) updated successfully";
    }
}

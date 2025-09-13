<?php
namespace App\GraphQL\Mutation;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Validator;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateMovieMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateMovie'
    ];
    public function type(): Type
    {
        return GraphQL::type('Movie');
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

    /**
     * @throws \Exception
     */
    public function resolve($root, $args)
    {

        $rules = [
            'id' => 'required|exists:movies,id',
            'name' => 'sometimes|string|max:255',
            'overview' => 'sometimes|string',
            'budget' => 'sometimes|integer|min:0',
            'boxOffice' => 'sometimes|integer|min:0',
            'year' => 'sometimes|integer|min:1800|max:' . date('Y'),
            'country' => 'sometimes|string|max:255',
            'director' => 'sometimes|string|exists:directors,name',
            'genres' => 'sometimes|array|min:1',
            'genres.*' => 'string|exists:genres,name',
        ];

        $validator = Validator::make($args, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }


        $movie = Movie::find($args['id']);

        foreach ($args as $key => $value) {
            if (!in_array($key, ['id', 'genres', 'director'])) {
                $movie->$key = $value;
            }
        }

        if (isset($args['director'])) {
            $director = Director::where('name', $args['director'])->first();
            $movie->director_id = $director->id;
        }
        $movie->save();

        if (isset($args['genres'])) {
            $genreIds = Genre::whereIn('name', $args['genres'])->pluck('id')->toArray();
            $movie->genres()->sync($genreIds);
        }

        return $movie;
    }
}

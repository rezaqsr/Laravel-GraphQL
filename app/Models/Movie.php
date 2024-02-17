<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function director(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Director::class);
    }
    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class , 'movie_genre');
    }
}

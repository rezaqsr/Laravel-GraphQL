<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];
    public function movies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Movie::class);
    }
}

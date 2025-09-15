<?php

use Illuminate\Support\Facades\Route;

//Route::get('/movies', function () {
//    return view('movies');
//});
Route::get('/{any}', function () {
    return view('movies');
})->where('any', '.*');

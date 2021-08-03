<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', function() {
    return response()->json(
        [
            "firstname" => "Gianluca",
            "lastname" => "Pesce",
            "age" => 38
        ]
    );
});

Route::post('/rotta-post', function() {

    $studenti = [
        [
            'firstname' => 'Giorgio',
            'lastname' => 'Zocchi'
        ],
        [
            'firstname' => 'Marco',
            'lastname' => 'Canopoli'
        ]
    ];    

    return response()->json($studenti);
});

Route::namespace('Api')
    ->group(function() {

        Route::get('posts', 'PostController@index');
        Route::get('posts/{slug}', 'PostController@show');
        Route::get('categories/{slug}', 'CategoryController@show');

        Route::get('tags/{slug}', 'TagController@show');

        Route::get('categories', 'CategoryController@index');

    });



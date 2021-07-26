<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes(["register" => false]); // per disabilitare la registrazione
// Auth::routes(["verify" => true]); // per attivare la verifica mail al momento della registrazione

// ROTTE per Autenticazione
Auth::routes();

// tutte le rotte protette da autenticazione (ADMIN)
Route::middleware('auth') // autenticazione
    ->namespace('Admin') // controller
    ->name('admin.') // nome rotte
    ->prefix('admin') // url rotte
    ->group(function() {

        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', 'PostController');

});

// Rotte pubbliche
// Route::get('/', 'HomeController@index')->name('home');
Route::get('{any?}', 'HomeController@index')->where('any', '.*')->name('home');

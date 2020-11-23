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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
Route::prefix('/v1')->group(function () {
   
    Route::post('/login', 'UserController@login');
    Route::post('/register-user', 'UserController@registerUser');
    Route::get('/users', 'UserController@index');

    Route::delete('/delete-user/{id}', 'UserController@destroy');
    Route::put('/update-user/{id}', 'UserController@update');

    Route::post('/register-note', 'NoteController@store');
    Route::get('/matriz', 'NoteController@index');
    
});

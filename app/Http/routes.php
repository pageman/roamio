<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Entry;
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api','after' => 'CORS'],function(){
    Route::get('test',function(){
        $entries = Entry::with('locations')->with('participants')->with('tags')->with('days')->with('hours')->get();
        return $entries->toJson();
    });

    Route::get('get-by-rating','FrontController@getByHighestRating');
    Route::get('get-by-id/{id}','FrontController@getById');
    Route::get('get-by-date','FrontController@getByCreatedAt');
    Route::get('search','FrontController@search');

    Route::get('/bot/update','BotController@getUpdates');
});


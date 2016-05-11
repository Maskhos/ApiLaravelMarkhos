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
//
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/faction', 'factionController@index');
Route::get('/category', 'categoryController@index');
Route::get('/country', 'countryController@index');
Route::get('/character', 'characterController@index');
Route::get('/comment', 'commentController@index');
Route::get('/history', 'historyController@index');
Route::get('/mechanic', 'mechanicController@index');

//USER
Route::get('/post', 'postController@index');
//GET
Route::get('/user', 'UserController@index');
Route::get('/user/{user}', 'UserController@show');
//POST
Route::post('/user', 'UserController@store');
//DELETE
Route::delete('/user/{user}', 'UserController@delete');
//PUT
Route::put('/user/{user}', 'UserController@update');

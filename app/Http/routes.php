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
 Route::get('/', function () {
     return "(/resource) para encontrar lo que andas buscando";
 });
//PRUEBA
//GET
Route::get('/prueba', 'pruebaController@index');
//POST
Route::post('/prueba', 'pruebaController@store');
//CATEGORY
//GET
Route::get('/category', 'categoryController@index');
Route::get('/category/{category}', 'categoryController@show');
//POST
Route::post('/category', 'categoryController@store');
//DELETE
Route::delete('/category/{category}', 'categoryController@destroy');
//PUT
Route::put('/category/{category}', 'categoryController@update');
Route::patch('/category/{category}', 'categoryController@update');

//CHARACTER
//GET
Route::get('/character', 'characterController@index');
Route::get('/character/{character}', 'characterController@show');
//POST
Route::post('/character', 'characterController@store');
//DELETE
Route::delete('/character/{character}', 'characterController@destroy');
//PUT
Route::put('/character/{character}', 'characterController@update');
Route::patch('/character/{character}', 'characterController@update');

//COMMENT
//Get
Route::get('/comment', 'commentController@index');
Route::get('/comment/show/{comment}', 'commentController@showCommentsPost');
Route::get('/comment/{comment}', 'commentController@show');
//POST
Route::post('/comment', 'commentController@store');
//DELETE
Route::delete('/comment/{comment}', 'commentController@destroy');
//PUT
Route::put('/comment/{comment}', 'commentController@update');
Route::patch('/comment/{comment}', 'commentController@update');


//COUNTRY
//Get
Route::get('/country', 'countryController@index');
Route::get('/country/{country}', 'countryController@show');
//POST
Route::post('/country', 'countryController@store');
//DELETE
Route::delete('/country/{country}', 'countryController@destroy');
//PUT
Route::put('/country/{country}', 'countryController@update');
Route::patch('/country/{country}', 'countryController@update');

//FACTION
//Get
Route::get('/faction', 'factionController@index');
Route::get('/faction/{faction}', 'factionController@show');
//POST
Route::post('/faction', 'factionController@store');
//DELETE
Route::delete('/faction/{faction}', 'factionController@destroy');
//PUT
Route::put('/faction/{faction}', 'factionController@update');
Route::patch('/faction/{faction}', 'factionController@update');

//HISTORY
//GET
Route::get('/history', 'historyController@index');
Route::get('/history/{history}', 'historyController@show');
//POST
Route::post('/history', 'historyController@store');
//DELETE
Route::delete('/history/{history}', 'historyController@destroy');
//PUT
Route::put('/history/{history}', 'historyController@update');
Route::patch('/history/{history}', 'historyController@update');

//MECHANIC
//GET
Route::get('/mechanic', 'MechanicController@index');
Route::get('/mechanic/{mechanic}', 'MechanicController@show');
//POST
Route::post('/mechanic', 'MechanicController@store');
//DELETE
Route::delete('/mechanic/{mechanic}', 'MechanicController@destroy');
//PUT
Route::put('/mechanic/{mechanic}', 'MechanicController@update');
Route::patch('/mechanic/{mechanic}', 'MechanicController@update');
//POSTS WEB
//GET
Route::get('/post', 'postController@index');
Route::get('/post/last/{limit}', 'postController@lastspost');
Route::get('/post/{post}', 'postController@show');
//POST
Route::post('/post', 'postController@store');
//DELETE
Route::delete('/post/{post}', 'postController@destroy');
//PUT
Route::post('/post/{post}/{type}', 'postController@update');
//USER
//GET
Route::get('/user', 'UserController@index');
Route::get('/user/{user}', 'UserController@show');
//POST
Route::post('/user', 'UserController@store');
//DELETE
Route::delete('/user/{user}', 'UserController@delete');
//PUT
Route::post('/user/{user}/{type}', 'UserController@update');
//LOGINTOWEB

Route::get('/user/{id}/{token}', 'UserController@bytoken');

Route::post('/user/{id}/{token}', 'UserController@remember_token');

Route::post('/user/credentials', 'UserController@login');
//SHOWTOKEN
Route::get('/token', 'UserController@token');

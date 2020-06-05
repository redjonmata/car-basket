<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth');


//Route::get('/my-cars', 'HomeController@showCars')->middleware('auth');
//
//Route::get('/add-test', 'CarController@show');
//Route::post('/add-test', 'CarController@create');
//
//Route::get('/draft', 'CarController@draft')->middleware('admin');
//Route::put('/draft/car/{id}', 'CarController@update');
//Route::delete('/draft/car/{id}', 'CarController@delete');
//
//Route::get('/tags', 'CarController@getTags');
//Route::get('/cars/tag/{name}', 'CarController@getCars');
//
Route::put('/users/{id}', 'HomeController@update');
Route::delete('/users/{id}', 'HomeController@delete');
Route::get('/add-user', 'HomeController@store');
//
//Route::get('/search', 'CarController@search');

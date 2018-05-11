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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/img/{path}', 'ImageController@show')->where('path', '.*');

Route::get('recipes', 'RecipeController@index');
Route::get('recipes/{recipe}', 'RecipeController@show')->name('recipes.show');
Route::get('my-recipes', 'UserRecipeController@index')->name('my-recipes');
Route::get('my-recipes/add', 'UserRecipeController@create')->name('recipes.create');
Route::post('my-recipes/add', 'UserRecipeController@store');
Route::delete('my-recipes/{recipe}', 'UserRecipeController@delete')->name('recipes.delete');
Route::get('my-recipes/{recipe}/edit', 'UserRecipeController@edit')->name('recipes.edit');
Route::post('my-recipes/{recipe}/edit', 'UserRecipeController@update');

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('/', 'HomeController@index')->name('home');


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


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

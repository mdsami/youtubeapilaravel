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

Route::get('/', 'HomeController@index');


Auth::routes();

Route::middleware(['checkadmin'])->group(function () {
Route::get('/home', 'AdminController@index')->name('home');
Route::post('/save-video', 'AdminController@saveVideo')->name('save-video');
});
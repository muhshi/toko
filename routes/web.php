<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
| 
*/

Route::get('/', 'PagesController@homepage');
Route::get('/home', 'PagesController@homepage');

#ajax
Route::get('/ajax/kab', 'TokoController@kab');
Route::get('/ajax/kec', 'TokoController@kec');

Auth::routes();

#profil
Route::get('/profil/', 'ProfilController@index');
Route::get('/profil/edit', 'ProfilController@edit');
Route::get('upload', function() {
  return View::make('pages.upload');
});
Route::post('profil/upload', 'ProfilController@upload');
Route::get('/profil/survei', 'ProfilController@ajax');
Route::get('/profil/realisasi', 'ProfilController@realisasi');

#Lisensi
Route::get('/lisensi/create', 'LisensiController@create');
Route::post('/lisensi/store', 'LisensiController@store');
Route::get('/lisensi/show', 'LisensiController@show');
Route::get('lisensi/{lisensi}', 'LisensiController@detail');
Route::delete('/lisensi/{lisensi}', 'LisensiController@delete');
Route::get('lisensi/edit/{lisensi}', 'LisensiController@edit');
Route::post('lisensi/update', 'LisensiController@update');

#user
Route::get('/user/create', 'UserController@create');
Route::post('/user/store', 'UserController@store');
Route::get('/user/show', 'UserController@show');
Route::get('user/{user}', 'UserController@detail');
Route::delete('/user/{user}', 'UserController@delete');
Route::get('user/edit/{user}', 'UserController@edit');
Route::post('user/update', 'UserController@update');

#toko
Route::get('/toko/create', 'TokoController@create');
Route::post('/toko/store', 'TokoController@store');
Route::get('/toko/show', 'TokoController@show');
Route::get('toko/{toko}', 'TokoController@detail');
Route::delete('/toko/{toko}', 'TokoController@delete');
Route::get('toko/edit/{toko}', 'TokoController@edit');
Route::post('toko/update', 'TokoController@update');

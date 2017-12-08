<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/team/selected', 'HomeController@setMyTeam');


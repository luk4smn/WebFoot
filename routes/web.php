<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/team/selected', 'HomeController@setMyTeam');

Route::group(['prefix' => 'partidas'], function () {
    Route::get('/', 'PartidasController@indexMeuTime')->name('minhas.proximas.partidas');
    Route::get('/{id}/jogar', 'PartidasController@jogar')->name('jogar');

});

Route::group(['prefix' => 'classificacao'], function () {
    Route::get('/', 'ClassificacaoController@index')->name('classificacao');

});

Route::group(['prefix' => 'calendario'], function () {
    Route::get('/', 'PartidasController@index')->name('calendario');
});

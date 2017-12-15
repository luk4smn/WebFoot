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

    Route::get('/mensagens', 'TimesController@messages');

    Route::get('/estadio', 'TimesController@estadio');
    Route::put('/estadio/update', 'TimesController@estadioUpdate');

    Route::get('/meus-jogadores', 'TimesController@getElenco')->name('meus.jogadores');
    Route::get('/meus-jogadores/{id}/dispensar', 'TimesController@dispensar')->name('dispensar.jogador');

    Route::get('/comprar-jogadores', 'TimesController@getJogadoresParaCompra');
    Route::get('/comprar-jogadores/{id}/contratar', 'TimesController@contratar')->name('contratar.jogador');

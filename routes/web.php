<?php


Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => '/'], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index');


    Route::post('/team/selected', 'HomeController@setMyTeam');

    Route::get('/partidas', 'PartidasController@indexMeuTime')->name('minhas.proximas.partidas');


    Route::group(['prefix' => 'jogar'], function () {
        Route::get('/', 'PartidasController@jogar')->name('jogar');
    });

    Route::get('/resultados', 'PartidasController@resultados');

    Route::get('/resultados-rodada', 'PartidasController@resultadosRodada')->name('rodada-results');

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
});
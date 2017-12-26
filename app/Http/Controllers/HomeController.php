<?php

namespace App\Http\Controllers;

use App\Entities\Classificacao;
use App\Entities\Mensagem;
use App\Entities\Partida;
use App\Entities\Time;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(auth()->user()->time_id == null){
            $times = Time::where('user_id', null)->get();

            return view('time.selectTeam', compact('times'));
        }

        $proximo_jogo = Partida::where('partidas.placar_mandante','=', null)
            ->where('time_mandante_id',auth()->user()->time_id)
            ->orWhere('time_visitante_id',auth()->user()->time_id)
            ->where('partidas.placar_mandante','=', null)
            ->orderBy('partidas.id')
            ->get()
            ->first() ?? '';

        $mandante = '';
        $visitante = '';

        if($proximo_jogo != ''){
            $mandante = Time::findOrFail($proximo_jogo->time_mandante_id) ?? '';
            $visitante = Time::findOrFail($proximo_jogo->time_visitante_id) ?? '';
        }else{
            $partidaModel = new Partida();
            $partidas_fantantes = Partida::where('partidas.placar_mandante','=', null)->get();
            $partidaModel->setPartidasFaltantesResults($partidas_fantantes); //caso fique alguma partida sem resultado por conta de erro esse metodo resolve o problema
        }

        return view('home',compact('proximo_jogo','mandante','visitante'));
    }

    public function setMyTeam(Request $request){

        if(sizeof($request->radio) != 1){
            return redirect()->back()->withErrors('Selecione um (e somente um) time');
        };

        auth()->user()->time_id = $request->radio['time_id'];

        $time_escolhido = Time::findOrFail($request->radio['time_id']);

        $time_escolhido->user_id = auth()->user()->id;

        $time_escolhido->save();

        auth()->user()->save();

        return redirect()->to('/');
    }

    public function resetChampioship(){
        $rodadas = Partida::all();
        $classificacao = Classificacao::all();
        $mensagens = Mensagem::all();

        foreach($rodadas as $key => $partida){
            $partida->placar_mandante = null;
            $partida->placar_visitante = null;
            $partida->save();
        }

        foreach($classificacao as $key => $time){
            $time->vitorias = 0;
            $time->empates = 0;
            $time->derrotas = 0;
            $time->pontuacao = 0;
            $time->save();
        }

        foreach($mensagens as $key => $mensagem){
            $mensagem->delete();
        }

        auth()->user()->time->user_id = null;
        auth()->user()->time->save();
        auth()->user()->time_id = null;
        auth()->user()->save();

        return redirect()->to('/');
    }

}

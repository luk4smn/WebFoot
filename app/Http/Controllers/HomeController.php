<?php

namespace App\Http\Controllers;

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
            ->first();


        $mandante = Time::findOrFail($proximo_jogo->time_mandante_id);
        $visitante = Time::findOrFail($proximo_jogo->time_visitante_id);

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

}

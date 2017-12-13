<?php

namespace App\Http\Controllers;

use App\Entities\Partida;
use App\Entities\Time;
use App\User;
use foo\bar;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        if(auth()->user()->time_id == null){
            $times = Time::get();

            return view('time.selectTeam', compact('times'));
        }

        $proximo_jogo = Partida::where('time_mandante_id',auth()->user()->time_id)
            ->orWhere('time_visitante_id',auth()->user()->time_id)
            ->Where('placar_mandante',null)
            ->orderBy('partidas.id')
            ->first();

        $mandante = Time::findOrFail($proximo_jogo->time_mandante_id);
        $visitante = Time::findOrFail($proximo_jogo->time_visitante_id);

        return view('home',compact('proximo_jogo','mandante','visitante'));
    }

    public function setMyTeam(Request $request){

        if(sizeof($request->radio) != 1 || isset($request->radio['time_id'])){
            return redirect()->back()->withErrors('Não é permitido selecionar mais de um time');
        };

        auth()->user()->time_id = $request->radio['time_id'];

        auth()->user()->save();

        return redirect()->to('/');
    }




}

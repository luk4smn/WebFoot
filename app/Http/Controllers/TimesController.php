<?php


namespace App\Http\Controllers;


use App\Entities\Jogador;

class TimesController extends Controller
{
    protected $model_jogador;

    public function __construct()
    {
        $this->model_jogador = app (Jogador::class);
    }

    public function getElenco(){
        $goleiros = auth()->user()->time->jogadores->where('posicao', "GOL");
        $defensores = auth()->user()->time->jogadores->where('posicao', "DEF");
        $meias = auth()->user()->time->jogadores->where('posicao', "MEI");
        $atacantes = auth()->user()->time->jogadores->where('posicao', "ATK");

        return view('time.meusJogadores',compact('goleiros','defensores','meias','atacantes'));
    }

    public function dispensar($id){
        $jogador = $this->model_jogador->findOrFail($id);

        auth()->user()->time->caixa += ($jogador->passe / 2);

        $jogador->time_id = null;

        $jogador->save();

        auth()->user()->time->save();

        return redirect('/');
    }

}
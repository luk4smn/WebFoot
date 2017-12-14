<?php


namespace App\Http\Controllers;


use App\Entities\Partida;

class PartidasController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = app( Partida::class);
    }

    public function index(){
        $partidas = $this->model->get();

        return view('campeonato.calendario' ,compact('partidas'));
    }

    public function indexMeuTime(){
        $partidas = $this->model->where('time_mandante_id',auth()->user()->time_id)
            ->orWhere('time_visitante_id',auth()->user()->time_id)
            ->where('placar_mandante',null)
            ->orderBy('partidas.id')
            ->get();

        return view('campeonato.calendario' ,compact('partidas'));
    }


    public function jogar($id){
        dd($id);
    }

}
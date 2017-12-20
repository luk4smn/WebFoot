<?php


namespace App\Http\Controllers;


use App\Entities\Partida;
use Symfony\Component\HttpFoundation\Request;

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


    public function jogar(Request $request){
//      $rodada = $this->model->where('placar_mandante',null)->limit(10)->get();

        $jogo = $this->model->findOrFail($request['partida_id']);

//        $jogo->time_visitante_id = auth()->user()->time_id ? :

        return view('jogo.escalacao');

    }

}
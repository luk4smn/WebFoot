<?php


namespace App\Http\Controllers;

use App\Entities\Classificacao;

class ClassificacaoController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = app(Classificacao::class);
    }


    public function index(){
        $classificacao = $this->model->orderBy('pontuacao','desc')
            ->orderBy('vitorias','desc')
            ->orderBy('empates','desc')
            ->orderBy('derrotas','asc')
            ->get();

        return view('campeonato.classificacao', compact('classificacao'));
    }
}
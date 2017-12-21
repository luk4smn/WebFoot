<?php


namespace App\Http\Controllers;


use App\Entities\Partida;
use App\Entities\Time;
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
        $partidas = $this->model->where('partidas.placar_mandante','=', null)
            ->where('time_mandante_id',auth()->user()->time_id)
            ->orWhere('time_visitante_id',auth()->user()->time_id)
            ->where('partidas.placar_mandante','=', null)
            ->orderBy('partidas.id')
            ->get();

        return view('campeonato.calendario' ,compact('partidas'));
    }


    public function jogar(Request $request){

        $meu_elenco = [
            'goleiros'   => auth()->user()->time->jogadores->where('posicao', "GOL"),
            'defensores' => auth()->user()->time->jogadores->where('posicao', "DEF"),
            'meias'      => auth()->user()->time->jogadores->where('posicao', "MEI"),
            'atacantes'  => auth()->user()->time->jogadores->where('posicao', "ATK"),
        ] ;

        $jogo = $this->model->findOrFail($request['partida_id']);

        if($jogo->time_visitante_id == auth()->user()->time_id || $jogo->time_mandante_id == auth()->user()->time_id) {
            return view('jogo.escalacao', compact('meu_elenco', 'jogo'));

        }else{
            return redirect()->to('/')->withErrors('A partida informada não é do seu time, tente novamente');

        }

    }

    public function resultados(Request $request){
        $slugDef = ""; $slugMei = ""; $slugAtk = "";
        $randomFormationAtk = 0; $randomFormationDef = 0;
        $myAtk = 0; $myDef = 0;

        if(isset($request['formacao'])){
            switch ($request['formacao']){
                case (Time::FORMACAO_4_4_2);
                    count($request['defensores_id']) <> 4 ? $slugDef = "Erro" : null ;
                    count($request['meias_id'])     <> 4 ? $slugMei = "Erro" : null ;
                    count($request['atacantes_id']) <> 2 ? $slugAtk = "Erro" : null ;
                    break;

                case (Time::FORMACAO_4_3_3);
                    count($request['defensores_id']) <> 4 ? $slugDef = "Erro" : null ;
                    count($request['meias_id'])     <> 3 ? $slugMei = "Erro" : null ;
                    count($request['atacantes_id']) <> 3 ? $slugAtk = "Erro" : null ;
                    break;

                case (Time::FORMACAO_4_5_1);
                    count($request['defensores_id']) <> 4 ? $slugDef = "Erro" : null ;
                    count($request['meias_id'])     <> 5 ? $slugMei = "Erro" : null ;
                    count($request['atacantes_id']) <> 1 ? $slugAtk = "Erro" : null ;
                    break;

                case (Time::FORMACAO_3_5_2);
                    count($request['defensores_id']) <> 3 ? $slugDef = "Erro" : null ;
                    count($request['meias_id'])     <> 5 ? $slugMei = "Erro" : null ;
                    count($request['atacantes_id']) <> 2 ? $slugAtk = "Erro" : null ;
                    break;
            }
        }


        if($slugDef != "Erro" && $slugMei != "Erro" && $slugAtk != "Erro"){

            $minha_partida = $this->model->findOrFail($request['jogo_id']);

            if($minha_partida->time_mandante_id == auth()->user()->time_id){ // eu sou o mandante ? se sim, faço a formação random do visitante
                $randomFormationAtk = $minha_partida->visitante->randomFormationAtkRating();
                $randomFormationDef = $minha_partida->visitante->randomFormationDefRating();

                $myAtk = $minha_partida->mandante->setMyFormationAtkRating($request->all());
                $myDef = $minha_partida->mandante->setMyFormationDefRating($request->all());

            }else{
                $randomFormationAtk = $minha_partida->mandante->randomFormationAtkRating();
                $randomFormationDef = $minha_partida->mandante->randomFormationDefRating();

                $myAtk = $minha_partida->visitante->setMyFormationAtkRating($request->all());
                $myDef = $minha_partida->visitante->setMyFormationDefRating($request->all());
            }

            $this->model->setMyResult($minha_partida, $myAtk , $myDef, $randomFormationAtk, $randomFormationDef);

            $resultados = $this->model->setRodadaResults($request['jogo_id']);

            $resultados->toArray();

            return redirect()->to(route('rodada-results',['meu_resultado_id' => $request['jogo_id']]));

        }
        else{
            return redirect()->back()->withErrors('Atenção : Escolha sua Escalação de acordo com a formação escolhida.');

        }
    }

    public function resultadosRodada(Request $request){
        $meu_resultado = $this->model->findOrFail($request['meu_resultado_id']);

        $resultados = $this->model->setRodadaResults($request['meu_resultado_id']);

        return view('campeonato.resultado_rodada' ,compact('meu_resultado', 'resultados'));
    }

}
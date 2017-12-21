<?php


namespace App\Entities;


class Partida extends Entity
{

    protected $table = "partidas";

    protected $fillable = [
        'campeonato_id',
        'time_mandante_id',
        'time_visitante_id' ,
        'placar_mandante',
        'placar_visitante'
    ];

    public function campeonato(){
        return $campeonato = Campeonato::get()->toArray();
    }

    public function mandante(){
        return $this->hasOne(Time::class, 'id',"time_mandante_id");
    }

    public function visitante(){
        return $this->hasOne(Time::class, 'id',"time_visitante_id");
    }

    public function getTimes(){
        return $times = Time::pluck('id')->toArray();
    }

    public function setSorteio(){
        $times = $this->getTimes();
        $qtde_times = sizeof($times);                            // Quantidade de Times
        $num_rodadas = $this->campeonato()[0]['num_rodadas'];   //numero de rodadas


        for($i=0; $i< $qtde_times/2 ; $i++){
            $tabelaA[] = $i+1;
            $tabelaB[] = ($qtde_times-$i);

            $this->createTurno($tabelaA[$i],$tabelaB[$i]);   // cria a primeira rodada
        }

        for($index = 2; $index <= $num_rodadas /2; $index++){  // cria as rodadas subsequntes
            $auxiliarA = $tabelaA;

            $auxiliarB = $tabelaB;

            $auxiliarA[1] = $tabelaB[0];
            $auxiliarB[9] = $tabelaA[9];

            for($i=2; $i< sizeof($tabelaA);$i++){
                $auxiliarA[$i] = $tabelaA[$i -1];

            }

            for($i=0; $i< sizeof($tabelaB) - 1  ;$i++){
                $auxiliarB[$i] = $tabelaB[$i + 1];
            }

            $tabelaA = $auxiliarA;
            $tabelaB = $auxiliarB;

            foreach ($tabelaA as $key=> $id){
                $this->createTurno($tabelaA[$key], $tabelaB[$key]);
            }
        }

        $this->createReturno();

    }

    public function createTurno($mandante,$visitante){          //cria o primeiro turno do campeonato
        $this->create([
                'campeonato_id' => 1,
                'time_mandante_id' => $mandante,
                'time_visitante_id' => $visitante,
            ]);
    }

    public function createReturno(){                            //cria o segundo turno do campeonato
        $turno = $this->get();

        foreach ($turno as $key=>$partida){
            $this->create([
                'campeonato_id' => 1,
                'time_mandante_id' => $partida->time_visitante_id,
                'time_visitante_id' => $partida->time_mandante_id,
            ]);
        }
    }

    public function setRodadaResults($id){
        $rodada = $this->where('placar_mandante',null)->where('id', '!=', $id)->limit(9)->get();

        foreach ($rodada as $key => $partida){
            $placar_machine1 = 0; $placar_machine2 = 0;

            if($partida->mandante->getRatingAtk() > $partida->visitante->getRatingDef()){
                $placar_machine1 = rand(0,10);
            }else{
                $placar_machine1 = rand(0,5);
            }
            if($partida->visitante->getRatingAtk() > $partida->mandante->getRatingDef()){
                $placar_machine2 = rand(0,10);
            }else{
                $placar_machine2 = rand(0,5);
            }

            $partida->update([
                'placar_mandante' => $placar_machine1,
                'placar_visitante' => $placar_machine2
            ]);

            if($partida->placar_mandante > $partida->placar_visitante){     //vitoria do mandante
                $partida->mandante->classificacao->vitorias += 1;
                $partida->visitante->classificacao->derrotas += 1;

                $partida->mandante->classificacao->pontuacao += 3;

                $partida->mandante->classificacao->save();
                $partida->visitante->classificacao->save();

            }
            elseif($partida->placar_mandante == $partida->placar_visitante){ // empate
                $partida->mandante->classificacao->empates += 1;
                $partida->visitante->classificacao->empates += 1;

                $partida->mandante->classificacao->pontuacao += 1;
                $partida->visitante->classificacao->pontuacao += 1;

                $partida->mandante->classificacao->save();
                $partida->visitante->classificacao->save();
            }
            else{                                                           // vitoria do visitante
                $partida->mandante->classificacao->derrotas += 1;
                $partida->visitante->classificacao->vitorias += 1;

                $partida->visitante->classificacao->pontuacao += 3;

                $partida->mandante->classificacao->save();
                $partida->visitante->classificacao->save();
            }
        }
        $this->resultados = $rodada;
        return $rodada;
    }

    public function setMyResult($partida, $myAtk , $myDef, $adversarioAtk, $adversarioDef){

        $placar_mandante = 0; $placar_visitante = 0;

        if($partida->time_mandante_id == auth()->user()->time_id){ // sou mandante ?
            if($myAtk > $adversarioDef){
                $placar_mandante = rand(0,10);
            }else{
                $placar_mandante = rand(0,5);
            }
            if($adversarioAtk > $myDef){
                $placar_visitante = rand(0,10);
            }else{
                $placar_visitante = rand(0,5);
            }
        }else{                                                  //sou visitante
            if($myAtk > $adversarioDef){
                $placar_visitante = rand(0,10);
            }else{
                $placar_visitante = rand(0,5);
            }
            if($adversarioAtk > $myDef){
                $placar_mandante = rand(0,10);
            }else{
                $placar_mandante = rand(0,5);
            }
        }

        $partida->update([
            'placar_mandante' => $placar_mandante,
            'placar_visitante' => $placar_visitante
        ]);

        if($partida->placar_mandante > $partida->placar_visitante){     //vitoria do mandante
            $partida->mandante->classificacao->vitorias += 1;
            $partida->visitante->classificacao->derrotas += 1;

            $partida->mandante->classificacao->pontuacao += 3;

            $partida->mandante->classificacao->save();
            $partida->visitante->classificacao->save();

        }
        elseif($partida->placar_mandante == $partida->placar_visitante){ // empate
            $partida->mandante->classificacao->empates += 1;
            $partida->visitante->classificacao->empates += 1;

            $partida->mandante->classificacao->pontuacao += 1;
            $partida->visitante->classificacao->pontuacao += 1;

            $partida->mandante->classificacao->save();
            $partida->visitante->classificacao->save();
        }
        else{                                                           // vitoria do visitante
            $partida->mandante->classificacao->derrotas += 1;
            $partida->visitante->classificacao->vitorias += 1;

            $partida->visitante->classificacao->pontuacao += 3;

            $partida->mandante->classificacao->save();
            $partida->visitante->classificacao->save();
        }

        return $partida;
    }

}

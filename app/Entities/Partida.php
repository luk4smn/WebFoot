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
                'num_partidas'
            ]);
        }

    }
}

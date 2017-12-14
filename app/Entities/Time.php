<?php

namespace App\Entities;


class Time extends Entity
{
    protected $table = "times";

    protected $fillable = [
        'nome',
        'user_id' ,
        'estadio_id',
        'campeonato_id',
        'numero_torcedores',
        'caixa',
        'escudo'
    ];

    public function jogadores(){
        return $this->hasMany(Jogador::class, "time_id");
    }

    public function campeonato(){
        return $this->hasOne(Campeonato::class, "id","campeonato_id");
    }

    public function estadio(){
        return $this->belongsTo(Estadio::class, "estadio_id",'id');
    }
    public function classificacao(){
        return $this->hasOne(Classificacao::class, "time_id");
    }

    public function getSalariosJogadores(){
        $elenco = $this->jogadores;
        $soma= 0;

        foreach ($elenco as $key => $jogador){
            $soma += $jogador->salario;
        }

        return $soma;
    }

    public function setBallance(){
        $despesas = $this->getSalariosJogadores();

        $caixa = $this->caixa;

        $ballance = $caixa - $despesas;

        return $ballance;
    }

    public function getScoredGoals(){
        $scored = 0;

        $partidas_mandane = Partida::where('time_mandante_id',$this->id)->get();

        foreach ($partidas_mandane as $key => $partida){
            $scored += $partida->placar_mandante;
        }

        $partidas_visitante = Partida::where('time_visitante_id',$this->id)->get();

        foreach ($partidas_visitante as $key => $partida){
            $scored += $partida->placar_visitante;
        }

        return $scored;
    }

    public function getConceivedGoals(){
        $goals = 0;

        $partidas_mandane = Partida::where('time_mandante_id',$this->id)->get();

        foreach ($partidas_mandane as $key => $partida){
            $goals += $partida->placar_visitante;                            //gols q o visitante fez em vc
        }

        $partidas_visitante = Partida::where('time_visitante_id',$this->id)->get();

        foreach ($partidas_visitante as $key => $partida){
            $goals += $partida->placar_mandante;                            //gols q o mandante fez em vc
        }

        return $goals;
    }

}
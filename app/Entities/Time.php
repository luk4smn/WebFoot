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

    const
        FORMACAO_4_4_2 = 0,
        FORMACAO_4_3_3 = 1,
        FORMACAO_4_5_1 = 2,
        FORMACAO_3_5_2 = 3;

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

    public function getRatingAtk(){
        return round($rating = ($this->jogadores->sum('atk_rate') / count($this->jogadores)));
    }

    public function getRatingDef(){
        return round($rating = ($this->jogadores->sum('def_rate') / count($this->jogadores)));
    }

    public function randomFormationAtkRating(){
        $atk_rating = 0;

        $goleiro   = $this->jogadores->where('posicao', "GOL")->first();
        $defensores = $this->jogadores->where('posicao', "DEF");
        $meias      = $this->jogadores->where('posicao', "MEI");
        $atacantes  = $this->jogadores->where('posicao', "ATK");

        $atk_rating += $goleiro->atk_rate;

        for($i=0; $i<=3; $i++){
            $atk_rating += isset($defensores[$i]) ? $defensores[$i]->atk_rate : 60;
            $atk_rating += isset($meias[$i]) ? $meias[$i]->atk_rate : 60;
        }

        for($i=0; $i<=1; $i++){
            $atk_rating += isset($atacantes[$i]) ? $atacantes[$i]->atk_rate : 65;
        }

        return round($atk_rating /= 10);
    }

    public function randomFormationDefRating(){
        $def_rating = 0;

        $goleiro   = $this->jogadores->where('posicao', "GOL")->first();
        $defensores = $this->jogadores->where('posicao', "DEF");
        $meias      = $this->jogadores->where('posicao', "MEI");
        $atacantes  = $this->jogadores->where('posicao', "ATK");

        $def_rating += $goleiro->def_rate;

        for($i=0; $i<=3; $i++){
            $def_rating += isset($defensores[$i]) ? $defensores[$i]->def_rate : 60;
            $def_rating += isset($meias[$i]) ? $meias[$i]->def_rate : 60;
        }

        for($i=0; $i<=1; $i++){
            $def_rating += isset($atacantes[$i]) ? $atacantes[$i]->def_rate : 65;
        }

        return round($def_rating /= 10);
    }

    public function setMyFormationAtkRating($array){
        $atk_rating = 0;

        $goleiro = $this->jogadores->find($array['goleiro_id']);

        $atk_rating += $goleiro->atk_rate;

        foreach ($array['defensores_id'] as $key => $id){
            $defensor = $this->jogadores->find($id);
            $atk_rating += $defensor->atk_rate;
        }
        foreach ($array['meias_id'] as $key => $id){
            $meia = $this->jogadores->find($id);
            $atk_rating += $meia->atk_rate;
        }
        foreach ($array['atacantes_id'] as $key => $id){
            $atacante = $this->jogadores->find($id);
            $atk_rating += $atacante->atk_rate;
        }

        $array['formacao'] == 0 ? $atk_rating += 5 : NULL;
        $array['formacao'] == 1 ? $atk_rating += 10 : NULL;
        $array['formacao'] == 2 ? $atk_rating += 4 : NULL;
        $array['formacao'] == 3 ? $atk_rating += 7 : NULL;

        return (round($atk_rating /= 10));

    }

    public function setMyFormationDefRating($array){
        $def_rating = 0;

        $goleiro = $this->jogadores->find($array['goleiro_id']);

        $def_rating += $goleiro->def_rate;

        foreach ($array['defensores_id'] as $key => $id){
            $defensor = $this->jogadores->find($id);
            $def_rating += $defensor->def_rate;
        }
        foreach ($array['meias_id'] as $key => $id){
            $meia = $this->jogadores->find($id);
            $def_rating += $meia->def_rate;
        }
        foreach ($array['atacantes_id'] as $key => $id){
            $atacante = $this->jogadores->find($id);
            $def_rating += $atacante->def_rate;
        }

        $array['formacao'] == 0 ? $def_rating += 7 : NULL;
        $array['formacao'] == 1 ? $def_rating += 4 : NULL;
        $array['formacao'] == 2 ? $def_rating += 8 : NULL;
        $array['formacao'] == 3 ? $def_rating += 5 : NULL;


        return (round($def_rating /= 10));
    }

}
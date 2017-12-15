<?php


namespace App\Http\Controllers;


use App\Entities\Jogador;
use App\Entities\Mensagem;
use Illuminate\Http\Request;

class TimesController extends Controller
{
    protected $model_jogador;
    protected $model_mensagem;

    public function __construct()
    {
        $this->model_jogador = app (Jogador::class);
        $this->model_mensagem = app (Mensagem::class);
    }

    public function getElenco(){
        $goleiros = auth()->user()->time->jogadores->where('posicao', "GOL");
        $defensores = auth()->user()->time->jogadores->where('posicao', "DEF");
        $meias = auth()->user()->time->jogadores->where('posicao', "MEI");
        $atacantes = auth()->user()->time->jogadores->where('posicao', "ATK");

        return view('time.meusJogadores',compact('goleiros','defensores','meias','atacantes'));
    }

    public function getJogadoresParaCompra(){
        $jogadores = $this->model_jogador->where('time_id', null)->get();

        return view('time.comprarJogadores',compact('jogadores'));
    }

    public function dispensar($id){
        $jogador = $this->model_jogador->findOrFail($id);

        auth()->user()->time->caixa += ($jogador->passe / 2);

        $jogador->time_id = null;

        $jogador->save();

        auth()->user()->time->save();

        $this->model_mensagem->create([
            'mensagem' => "Você dispensou o jogador $jogador->nome, você recebeu ".($jogador->passe / 2)." pela operação.",
            'user_id' => auth()->user()->id
        ]);

        return redirect('/');
    }

    public function contratar($id){
        $jogador = $this->model_jogador->findOrFail($id);

        if(auth()->user()->time->setBallance() > 0 || auth()->user()->time->setBallance() >= $jogador->passe){

            auth()->user()->time->caixa -= ($jogador->passe);

            $jogador->time_id = auth()->user()->time->id;

            $jogador->save();

            auth()->user()->time->save();

            $this->model_mensagem->create([
                'mensagem' => "$jogador->nome Assinou Contrato com o seu time. Foi descontado do seu caixa ".($jogador->passe)." pela operação.",
                'user_id' => auth()->user()->id
            ]);

            return redirect('/');
        }

        else{
            return redirect()->back()->withErrors('Não foi possivel comprar o jogador, seu saldo não é suficiente');
        }

    }

    public function messages(){
        $mensagens = auth()->user()->mensagens;

        return view('time.mensagens',compact('mensagens'));
    }

    public function estadio(){
        return view('time.estadio');
    }

    public function estadioUpdate(Request $request){
        auth()->user()->time->estadio->update($request->all());

        return redirect('/');
    }

}
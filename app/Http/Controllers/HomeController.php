<?php

namespace App\Http\Controllers;

use App\Entities\Time;
use App\User;
use foo\bar;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        if(auth()->user()->time_id == null){
            $times = Time::get();

            return view('time.selectTeam', compact('times'));
        }

        return view('home');
    }

    public function setMyTeam(Request $request){

        if(sizeof($request->radio) != 1){
            return redirect()->back()->withErrors('Não é permitido selecionar mais de um time');
        };

        auth()->user()->time_id = $request->radio['time_id'];

        auth()->user()->save();

        return redirect()->to('/');
    }
}

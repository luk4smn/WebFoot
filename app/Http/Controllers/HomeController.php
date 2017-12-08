<?php

namespace App\Http\Controllers;

use App\Entities\Time;
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

    public function setMyTeam(Time $team){
        dd($team);
    }
}

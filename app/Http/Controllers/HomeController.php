<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\User;
use App\Http\ScoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::lists('name', 'id');
        $Games = Game::orderBy('created_at', 'desc')->paginate(15);

        return view('home', compact('User','Games'));
    }
}

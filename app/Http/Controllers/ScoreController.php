<?php

namespace App\Http\Controllers;

use App\Game;
use App\Games_Users;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class ScoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \App\Http\Controllers\ScoreController
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        if($request->stat == '1vs1'){
            $this->player1_vs_player2($request);
        }else{
            $this->team1_vs_team2($request);
        }

        \Session::flash('flash_message','Your Score has benn Created.');

        return back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function player1_vs_player2($request){

        $this->validate($request, [
            'player_1' => 'required',
            'score_P1' => 'required|numeric|max:6',
            'player_2' => 'required',
            'score_P2' => 'required|numeric|max:6',
        ]);

        $games = new Game;
        $games->stat = $request->stat;
        $games->save();

        $player1 = new Games_Users();
        $player1->user_id = $request->player_1;
        $player1->score = $request->score_P1;

        $player2 = new Games_Users();
        $player2->user_id = $request->player_2;
        $player2->score = $request->score_P2;

        $games->games_users()->save( $player1 );
        $games->games_users()->save( $player2 );

    }


    public function team1_vs_team2($request){

        $messages = [
            'required' => 'The :attribute field is Required.',
        ];

        $this->validate($request, [
            'player_1' => 'required',
            'player_2' => 'required',
            'player_3' => 'required',
            'player_4' => 'required',
            'score_T1' => 'required|numeric|max:10',
            'score_T2' => 'required|numeric|max:10',

        ], $messages);

        $games = new Game;
        $games->stat = $request->stat;
        $games->save();

        $player1 = new Games_Users();
        $player1->user_id = $request->player_1;
        $player1->score =  $request->score_T1;

        $player2 = new Games_Users();
        $player2->user_id = $request->player_2;
        $player2->score =  $request->score_T1;

        $player3 = new Games_Users();
        $player3->user_id = $request->player_3;
        $player3->score = $request->score_T2;

        $player4 = new Games_Users();
        $player4->user_id = $request->player_4;
        $player4->score =  $request->score_T2;

        $games->games_users()->save( $player1 );
        $games->games_users()->save( $player2 );
        $games->games_users()->save( $player3 );
        $games->games_users()->save( $player4 );

    }
}

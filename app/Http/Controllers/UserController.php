<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        //----Top 10 User sort
        $top_10 = array();
        foreach($users as $key=>$user){
            $top_10[$user->SumScore()] = [
                'id'=>$user->id,
                'name'=>$user->name,
                'all_games'=>$user->games_users()->count()];
        }
        krsort($top_10);

        return view('user.index', compact('top_10'));
    }


    /**
     * Display the specified resource.
     *
     * @param User $user_id
     * @internal param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user_id)
    {
        foreach($user_id->games_users()->get() as $games_id){
           $user_games_id[] = $games_id->game_id;
         }

        $user_name = $user_id->name;
        $Games = Game::whereIn('id',$user_games_id)->orderBy('created_at', 'desc')->paginate(15);
        $User = User::lists('name', 'id');

        return view('home', compact('User','Games','user_name'));


    }





}

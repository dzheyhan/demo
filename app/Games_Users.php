<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games_Users extends Model
{
    protected $table = 'users_games';

    protected $fillable = [
        'user_id',
        'score'
    ];


    public function games() {
        return $this->belongsTo(Game::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


}

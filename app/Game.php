<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $table = 'games';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stat',
    ];

    public function games_users()
    {
        return $this->hasMany(Games_Users::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

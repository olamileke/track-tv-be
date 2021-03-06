<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;

use App\TvShow;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array 
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function generateToken()
    {
        $this->api_token=str_random(60);

        $this->save();

        return $this->api_token;
    }

    public function tvShows()
    {
        return $this->belongsToMany('App\TvShow', 'subscriptions', 'user_id', 'tvshow_id');
    }


    public function getLastName()
    {
        return explode(' ', $this->name)[1];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
    protected $fillable=['show_id', 'name', 'imagepath','next_episode_air_date','next_episode_number','next_episode_season'];


    public function users()
    {
    	return $this->belongsToMany('App\User', 'subscriptions', 'tvshow_id', 'user_id');
    }
}

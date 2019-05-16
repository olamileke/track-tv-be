<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use App\User;

use Carbon\Carbon;

class TvShow extends Model
{
    protected $fillable=['show_id', 'name', 'imagepath','next_episode_air_date','next_episode_number','next_episode_season', 'about_episode'];


    // RETURNING ALL THE USERS THAT ARE SUBSCRIBED TO A TV SHOW

    public function getUsers()
    {
    	$subs=DB::Table('subscriptions')->where('tvshow_id', $this->show_id)->select('user_id')->get();

    	$users=[];

    	foreach($subs as $sub)
    	{
    		$user=User::where('id', $sub->user_id)->first();

    		array_push($users, $user);
    	}	

    	return $users;
    }


    public function getFormattedDate()
    {
        $date=new Carbon($this->next_episode_air_date);

        return $date->toFormattedDateString();
    }
}

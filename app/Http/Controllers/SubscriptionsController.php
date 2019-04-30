<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\TvShow;

use Carbon\Carbon;

use Auth;

class SubscriptionsController extends Controller
{
	// RETURNING THE IDS OF THE TVSHOWS WITH THE TIME SUBSCRIBED BY THE LOGGED IN USER

    public function get()
    {
    	$user=Auth::guard('api')->user();

    	$tvshows=DB::Table('subscriptions')->where('user_id', $user->id)
    									   ->select('tvshow_id', 'created_at')
    									   ->get();

        $data=[];


        foreach($tvshows as $show)
        {
            $data[$show->tvshow_id]=Carbon::parse($show->created_at)->diffForHumans();
        }

        return response()->json($data, 200);
    }


    // SUBSCRIBING TO A TV SHOW

    public function subscribe(Request $request)
    {

        TvShow::firstOrCreate(['show_id'=>$request->show_id], ['show_id'=>$request->show_id, 'name'=>$request->name, 'imagepath'=>$request->imagepath, 'next_episode_air_date'=>$request->next_episode_air_date,
           'next_episode_number'=>$request->next_episode_number,
           'next_episode_season'=>$request->next_episode_season]);

        $user=Auth::guard('api')->user();

        $user->tvShows()->attach($request->show_id);

        return response()->json(['data'=>'Subscribed successfully', 200]);
    }


    // CHECKING IF THE USER HAS SUBSCRIBED TO A PARTICULAR TV SHOW

    public function hasSubscribed($id)
    {
        $user=Auth::guard('api')->user();

        $subscription=DB::Table('subscriptions')->where('user_id', $user)->where('tvshow_id', $id)->first();

        if($subscription) 
        {
            return response()->json(['data'=>true], 200);
        }

        return response()->json(['data'=>false], 200);
    }
}

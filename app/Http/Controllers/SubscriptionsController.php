<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\TvShow;

use Carbon\Carbon;

use Auth;

class SubscriptionsController extends Controller
{
    public function get()
    {
    	$user=Auth::guard('api')->user();

    	$tvshows=DB::Table('subscriptions')->where('user_id', $user->id)
    									   ->select('tvshow_id', 'created_at')
    									   ->get();

        $data=[];

        foreach($tvshows as $show)
        {
        	$tvshow=TvShow::where('show_id', $show->tvshow_id)
        				   ->select('show_id','name','next_episode_air_date', 'next_episode_number', 'next_episode_season', 'about_episode')
        				   ->first();

        	$tvshow->created_at=$show->created_at;

        	array_push($data, $tvshow);
        }

        return response()->json($data, 200);
    }                                                                             

    public function subscribe(Request $request)
    {
        TvShow::firstOrCreate(['show_id'=>$request->show_id], ['show_id'=>$request->show_id, 
            'name'=>$request->name, 
            'imagepath'=>$request->imagepath,
            // 'next_episode_title'=>$request->next_episode_title,
            'next_episode_air_date'=>$request->next_episode_air_date,
            'next_episode_number'=>$request->next_episode_number,
            'next_episode_season'=>$request->next_episode_season, 
            'about_episode'=>$request->about_episode]);

        $user=Auth::guard('api')->user();

        $user->tvShows()->attach($request->show_id);

        return response()->json(['data'=>$request->next_episode_title],200);
    }

    public function unsubscribe($id)
    {
    	$user=Auth::guard('api')->user();

    	DB::Table('subscriptions')->where('user_id', $user->id)->where('tvshow_id', $id)->delete();

    	return response()->json(['data'=>'Successfully unsubscribed'], 200);
    }

    public function getSubIDs()
    {
    	$user=Auth::guard('api')->user();

    	$subscriptions=DB::Table('subscriptions')->where('user_id', $user->id)->select('tvshow_id')->get();

    	$showIDs=[];

    	foreach($subscriptions as $subscription)
    	{
    		array_push($showIDs, $subscription->tvshow_id);
    	}

    	return response()->json([$showIDs],200);
    }

    public function hasSubscribed($id)
    {
    	$user=Auth::guard('api')->user();

    	$subscription=DB::Table('subscriptions')->where('user_id', $user->id)->where('tvshow_id', $id)->first();

    	if($subscription)
    	{
    		return response()->json(['data'=>true], 200);
    	}

    	return response()->json(['data'=>false],200);
    }
}

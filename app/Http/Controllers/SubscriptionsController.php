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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Token;

use App\Http\Resources\UserResource; 

use Auth;

class UsersController extends Controller
{
	// ACTIVATING A USER

    public function activate($token)
    {
    	$token=new Token($token);

    	$encryptedtoken=$token->getHash();

    	$user=User::where('activation_token', $encryptedtoken)->first();

    	if($user)
    	{
    		$user->is_activated=1;

	    	$user->activation_token=null;

	    	$user->save();

	    	$user->generateToken();

	    	return response()->json([new UserResource($user)], 200);

    	}

    	return response()->json(['data'=>'User not found'], 404);
    }


    public function imageUpload(Request $request)
    {
        $user=Auth::guard('api')->user();

        $image=$request->image;

        if($this->checkImageSize((int)$request->imagesize))
        {
            if($this->checkImageExtension($image))
            {
                $imagename=time().$image->getClientOriginalName();

                $image->move('Images/Users', $imagename);

                $user->avatar=asset('Images/Users/'.$imagename);

                $user->save();

                return response()->json(['data'=>$user->avatar], 200);
            }
            else
            {
                return response()->json(['data'=>'File format unsupported'], 406);
            }
        }
        else
        {
            return response()->json(['data'=>'Image is too large'], 413);
        }
       
    }


    public function checkImageSize($imagesize)
    {
        if($imagesize > 1024000)
        {
            return false;
        }

        return true;
    }


    public function checkImageExtension($image)
    {
        $extensions=['jpg','jpeg','png','gif'];

        $imgext=$image->getClientOriginalExtension();

        if(in_array($imgext, $extensions))
        {
            return true;
        }

        return false;
    }
}

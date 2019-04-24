<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Hash;

use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    private function credentials(Request $request)
    {
        $credentials=$request->only($this->username(), 'password');

        $credentials['is_activated']=1;

        return $credentials;
    }

    private function sendFailedLoginResponse(Request $request)
    {
        $error='Username or Password is not correct';

        $code=401;

        $user=User::where($this->username(), $request->{$this->username()})->first();

        if($user && Hash::check($request->password, $user->password) && $user->is_activated == 0)
        {
            $error='Please activate your account';

            $code=403;
        }

        return response()->json(['error'=>$error], $code);
    }


    public function logout()
    {
        $user=Auth::guard('api')->user();

        $user->api_token=null;

        $user->save();

        return response()->json(['data'=>'successfully logged out'], 200);
    }
}

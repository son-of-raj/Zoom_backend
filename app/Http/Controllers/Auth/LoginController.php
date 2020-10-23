<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Api_keys;
use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
     protected function authenticated(Request $request, $user)
    {
        $api_table = Api_keys::where('flag', '=', '0')->first();
        if($api_table !=''){
           $user_table = User::find(Auth::id());
           $user_table->api_id =  $api_table->id;
            $user_table->api_key = $api_table->api_key;
            $user_table->secret = $api_table->secret;
            // $user_table->save();
            if($user_table->save()){
                $api_table->flag = 1;
                if($api_table->save()){
                    return redirect('/');
                }else{
                    Auth::logout();
                    return redirect('/login');
                }
            }else{
                Auth::logout();
                return redirect('/login');
            }

            // return redirect('/');
        }else{
            Auth::logout();
            return redirect('/login');
        }
        
        die();
    }
}

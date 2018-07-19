<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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

    // to regard route after login
    protected function authenticated(Request $request, $user)
    {
        if($user->role == '0'){
            return redirect('profile');
        }
        if($user->role == '1'){
            return redirect('admin/photos');   
        }
    }

    // ovrride for regarding links redirect after logout
    public function logout(Request $request)
    {
        $redirect = "/";
        if(Auth::user()->role == '1'){
            $redirect = 'admin/login';   
        }   
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect($redirect);
    }

    // just add role check in login attempt
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['role' => $request->role]);
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {            
            if($request->route()->uri == 'login' || $request->route()->uri == 'admin/login'){
                if(Auth::check()){
                    if(Auth::user()->role == '1'){
                        if($request->route()->uri != 'login'){
                            return redirect('admin/photos');
                        }
                    }        

                    if(Auth::user()->role == '0'){
                        if($request->route()->uri != 'admin/login'){
                            return redirect('profile');
                        }
                    }   
                }
            }
            return $next($request);
        });        
    }
    
    public function showAdminLoginForm()
    {
        return view('auth.adminlogin');
    }
}

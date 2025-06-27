<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = '/home';
    // protected $redirectTo = '/dashboard';

    protected function authenticated()
    {
        if (Auth::user()->status == '0') {
            Auth::logout();
            return redirect('/login')->with('x', 'Akun anda telah dinonaktifkan !');;
        }
        
        if(Auth::user()->position->role_as == '1'){
            return redirect('/dashboard')->with('status', 'Selamat datang !');
        }else{
            return redirect('/profile')->with('status', 'Login berhasil !');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

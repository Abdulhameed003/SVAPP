<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    public function login(request $request){

        //validate request
        $this->validate($request,[
            'comapny_id'=>'required',
            'email'=> 'required|email|unique:user',
            'password'=>'required|min:6'
        ]);
        
        // try to login user
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password, 'company_id' => $request->company_id],$request->remember)){
            return redirect()->intended(route('dashboard.show'));
        }

        return redirect()->back()->withinput($request->only('email','remember'));
    }
}

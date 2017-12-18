<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;


class Log_inController extends Controller
{
     /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(){
       
        return  '/dashboard';
    }


    
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }


    public function show(){
        return view('auth.login');
    }

    public function login(request $request){

        //validate request
        $this->validate($request,[
            'company_id'=>'required',
            'email'=> 'required|email',
            'password'=>'required|min:6'
        ]);
        
        // try to login user
        if(Auth::attempt($this->Credentials($request),$request->remember)){
          
            return redirect()->intended(route('dashboard.show'));
        }

        return redirect()->back()->withInput($request->only('email','remember','company_id'))->withError($errors);
    }

    private function Credentials(request $request ){
        return $request->only('email','password','company_id');
    }
}

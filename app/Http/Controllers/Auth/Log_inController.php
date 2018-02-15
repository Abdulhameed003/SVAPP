<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
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

        return $this->sendFailedLoginResponse($request);
    }

    private function Credentials(request $request ){
        return $request->only('email','password','company_id');
    }

    protected function sendFailedLoginResponse(request $request){
     
        $errors= new MessageBag(['error' => 'Invalid Login Details']);
     

        return redirect()->back()
            ->withInput($request->only('company_id','email', 'remember'))
            ->withErrors($errors);
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}

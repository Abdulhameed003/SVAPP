<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Log_inController extends Controller
{

    public function show(){
        return view('auth.login');
    }

    public function login(request $request){

        //validate request
        $this->validate($request,[
            'comapny_id'=>'required',
            'email'=> 'required|email',
            'password'=>'required|min:6'
        ]);
        
        // try to login user
        if(Auth::attempt($this->Credentials($request),$request->remember)){
            return redirect()->intended(route(dashboard));

        }else {
            return 'failed';
        }

        return redirect()->back()->withinput($request->only('email','remember'));
    }

    private function Credentials(request $request ){
        return $request->only('company_id','email','password');
    }
}

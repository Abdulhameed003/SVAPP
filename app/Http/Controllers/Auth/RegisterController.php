<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Tenant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected function redirectTo(){

        return '/dashboard';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'company_id' => 'required|string|max:255',
            'user_role' => 'required|string|max:255',

        ]);
    }

    
    //Get company_id and check if name exist as a database
    private function CreatCompany(array $data){
        if(isNotEmpty(Tenant::find($request->company_id))) {
            return false;
        }else{
            $company= Tenant::create([
                'company_name' => $data['company_name'],
                'company_id'=> $data['company_id'],
                'company_phone'=> $data['company_phone']
            ]);
            
            return true;
        }
    }    

    //save comapny credentials to the SVapp database(default db)

    // if name exist then inform guest

    // create new users


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (CreateCompany($data)){
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'company_id' => $data['company_id'],
                'user_role' => $data['user_role'],
            ]);
        }else {
            return redirect()->back()->withInput($request->all()->except('password','company_id'))->with('error','The company ID already exist');
        }
    }

    // change default db to company db

}

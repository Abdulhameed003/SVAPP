<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Tenant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use App;

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

    private $dbaseName="";

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo(){
        
        return '/login';
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
    protected function validator($request)
    {
        return Validator::make($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'company_id' => 'required|string|unique:tenants|max:255',
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|string|max:255',
            'user_role' => 'required|string|max:255',

        ]);
    }

    public function register(request $request){
        $this->validator($request->all())->validate();
        
        if ($this->CreateCompany($request) == true ){
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'company_id' => $request->company_id,
                'user_role' => $request->user_role
            ]);
        }else {
            return redirect()->back()->withInput($request->except('password','company_id'));
        }
    }
    
  
    private function CreateCompany(request $request){
      
        if(Tenant::where('company_id',$request->company_id)->count() > 0) {
            return false;
        }else{
            $this->dbaseName = 'DB_'.$request->company_id;
            Tenant::create([
                'company_name' => $request->company_name,
                'company_id'=> $request->company_id,
                'company_phone'=> $request->company_phone
            ]);

            $this->createSchema($this->dbaseName);
            $this->configurDBConnection($this->dbaseName);
            Artisan::call('migrate', ['--database' => $this->dbaseName, '--path' => 'database/migrations', '--force' => true]);
            return true;
        }
    }    



  
   private function createSchema($schemaName)
   {
       
       return DB::statement('CREATE DATABASE '.$schemaName);
   }
   
  
    private function configurDBConnection($database)
    {
        // Just get access to the config. 
        $config = App::make('config');

        // Will contain the array of connections that appear in our database config file.
        $connections = $config->get('database.connections');

        // This line pulls out the default connection by key (by default it's `mysql`)
        $defaultConnection = $connections[$config->get('database.default')];

        // Now we simply copy the default connection information to our new connection.
        $newConnection = $defaultConnection;

        // Override the database name.
        $newConnection['database'] = $database;

       
        // This will add our new connection to the run-time configuration for the duration of the request.
        App::make('config')->set('database.connections.'.$database, $newConnection);
        
    }
  

}

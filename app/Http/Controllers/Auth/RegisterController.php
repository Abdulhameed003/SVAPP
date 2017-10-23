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
use Artisan;
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
    protected function validator($request)
    {
        return Validator::make($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'company_id' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_phone' => 'required|string|max:255',
            'user_role' => 'required|string|max:255',

        ]);
    }

    public function register(request $request){
        $this->validator($request->all())->validate();
        
        if ($this->CreateCompany($request) == true ){
            $tenantAdmin = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'company_id' => $request->company_id,
                'user_role' => $request->user_role
            ]);
        }else {
            return $tenantAdmin;//redirect()->back();//->withInput($data->all()->except('password','company_id'));
        }
    }
    
  
    private function CreateCompany($request){
      
        if(Tenant::where('company_id',$request->company_id)->count() > 0) {
            return false;
        }else{
            $company= Tenant::create([
                'company_name' => $request->company_name,
                'company_id'=> $request->company_id,
                'company_phone'=> $request->company_phone
            ]);
            $this->createSchema($request->company_id);
            $this->configurDB($request->company_id);
            Artisan::call('migrate', ['database' => $request->company_id, 'path' => 'database/migrations']);
            return true;
        }
    }    



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'company_id' => $data['company_id'],
                'user_role' => $data['user_role'],
            ]);
    }



    /**
    * Creates a new database schema.
    * @param  string $schemaName The new schema name.
    * @return bool
    */
   private function createSchema($schemaName)
   {
       
       return DB::statement('CREATE DATABASE '.$schemaName);
   }
   
    /**
     * Configures a tenant's database connection.
    * @param  string $Company_id The database name.
    * @return void
    */
    private function configurDB($company_id)
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
        $newConnection['database'] = $company_id;

        // This will add our new connection to the run-time configuration for the duration of the request.
        App::make('config')->set('database.connections.'.$company_id, $newConnection);

    }
  

}

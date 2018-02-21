<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesperson;

class SalesPersonController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesperson = Salesperson::withCount('projects')->orderBy('name', 'asc')->get();
        return $salesperson;        
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= ['salesperson_name'=>'required|string|max:255',
                 'salesperson_id'=>'required|string|max:255',
                 'salesperson_email'=>'required|email|string|max:255',
                 'salesperson_number'=>'required|string',
                 'salesperson_position'=>'required|string|max:50',
                 'Salesperson_password'=>'required|string'
        ];
        
        $this->validate($request,$rules);
        try{
            //creats salesperson in the database
            $salesperson = Salesperson::firstOrCreate(['salesperson_id'=>$request->salesperson_id],
                                    ['name'=>$request->salesperson_name,
                                    'email'=>$request->salesperson_email,
                                    'phone_num'=>$request->salesperson_number,
                                    'position'=>$request->salesperson_position]
            );
            $fullname = explode(' ',$request->salesperson_name,2);

            //creates login record for new salesperson.
            $salesperson->user()->firstOrCreate(['email' => $request->salesperson_email],
                                        ['first_name' => $fullname[0],
                                        'last_name' => !empty($fullname[1]) ? $fullname[1] : ' ',
                                        'password' => bcrypt($request->password),
                                        'company_id' => auth()->User()->company_id,
                                        'user_role' => $salesperson->position]
            );
            
            return 'success';
        }catch(\Exception $e){
            return 'failed';
        }

    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salesperson = Salesperson::find($id);
        if(auth()->User()->user_role != 'Admin'){
            return 'Unauthorized';
        }
        return 'success';

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule = ['salesperson_name'=>'required|string|max:255',
            'salesperson_id'=>'required|string|max:255',
            'salesperson_number'=>'required',
            'salesperson_position'=>'required|string|max:255'
        ];
        $this->validate($request,$rule);
        try{
            $salesperson = new  Salesperson();  
            $salesperson->name = $request->salesperson_name;
            $salesperson->salesperson_id = $request->salesperson_id;
            $salesperson->phone_num = $request->salesperson_number;
            $saleperson->position = $request->saleperson_position;
            $saleperson->save();

            return 'success';
        }catch(\Exception $e){
            return 'failed';
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{            
            if(auth()->User()->user_role == 'Admin' ){
                $salesperson = Salesperson::find($id);
                $salesperson->user()->where('email',$salesperson->email)->delete();
                $salesperson->delete();
                return 'success';
            }else{
                return 'unauthorized';
            }
        }catch(\Exception $e){
            return 'failed';
        }
    }
}

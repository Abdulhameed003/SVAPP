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
        $rules= ['name'=>'required|string|max:255',
                 'salesperson_id'=>'required|string|max:255',
                 'email'=>'required|email|string|max:255',
                 'phone_num'=>'required|string',
                 'position'=>'required|string|max:50',
                 'password'=>'required|string'
        ];
        
        $this->validate($request,$rules);
        try{
            //creats salesperson in the database
            $salesperson = Salesperson::firstOrCreate(['salesperson_id'=>$request->salesperson_id],
                                    ['name'=>$request->name,
                                    'email'=>$request->email,
                                    'phone_num'=>$request->phone_num,
                                    'position'=>$request->position]
            );
            $fullname = explode(' ',$request->name,2);

            //creates login record for new salesperson.
            $salesperson->user()->firstOrCreate(['email' => $request->email],
                                        ['first_name' => $fullname[0],
                                        'last_name' => !empty($fullname[1]) ? $fullname[1] : ' ',
                                        'password' => bcrypt($request->password),
                                        'company_id' => auth()->User()->company_id,
                                        'user_role' => $salesperson->position]
            );
            
            return Salesperson::getRecentUpdated($salesperson->id);
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
        $rule = ['name'=>'required|string|max:255',
            'salesperson_id'=>'required|string|max:255',
            'phone_num'=>'required',
            'position'=>'required|string|max:255'
        ];
        $this->validate($request,$rule);
        try{
            $salesperson = Salesperson::find($id);  
            $salesperson->name = $request->name;
            $salesperson->salesperson_id = $request->salesperson_id;
            $salesperson->phone_num = $request->phone_num;
            $salesperson->position = $request->position;
            $salesperson->save();

            return $salesperson;
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

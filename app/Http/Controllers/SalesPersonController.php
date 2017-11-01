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
        $salesperson = Salesperson::orderBy('name', 'asc')->get();
        return view('pages.salesperson')->with('salesperson',$salesperson);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                 'salesperson_email'=>'reqired|email|string|max:255',
                 'salesperson_number'=>'required|digit:11',
                 'salesperson_position'=>'required|string|max:50',
                 'Salesperson_password'=>'required|string|max:6'
        
                   
        ];
        $this->validate($request,$rules);
        //creats salesperson in the database
        $salesperson = Salesperson::firstOrCreate(['saleperson_id'=>$request->salesperson_id],
                                   ['name'=>$request->salesperson_name],
                                   ['email'=>$request->salesperson_email],
                                   ['phone_num'=>$request->salesperson_number],
                                   ['position'=>$request->salesperson_position]
        );
        $fullname = explode(' ',$request,2);

        //creates login record for new salesperson.
        $saleperson->user()->firstOrCreate(['email' => $request->email],
                                    ['first_name' => $fullname[0]],
                                    ['last_name' => !empty($fullname[1]) ? $fullname[1] : ' '],
                                    ['password' => bcrypt($request->password)],
                                    ['company_id' => auth()->User()->company_id],
                                    ['user_role' => $salesperson->salesperson_position]
        );
        
        return redirect('/salesperson')->with('success','record added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salesperson = Salesperson::with('projects')->where('id',$id)->get();
        return view('pages.sale_view')->with('salesperson', $salesersonp);

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
        if(auth()->User()->email !== $saleperson->email){
            return redirect('/salesperson')->with('error','Unauthorized page');
        }
        return view('pages.sales_edit')->with('saleperson',$saleperson);

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
            'salesperson_number'=>'required|digit:11',
            'salesperson_position'=>'required|string|max:50'
        ];
        $this->validate($request,$rule);

        $salesperson = new  Salesperson();  
        $salesperson->name = $request->salesperson_name;
        $salesperson->salesperson_id = $request->salesperson_id;
        $salesperson->phone_num = $request->salesperson_number;
        $saleperson->position = $request->saleperson_position;
        $saleperson->save();

        return redirect('/salesperson')->with('success','update successful');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saleperson = Salesperson::find($id);
        $salesperson->user()->dissociate();
        $salesperson->delete();

        return redirect('/salesperson')->with('success','Record has been deleted.');

    }
}

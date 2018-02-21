<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Company;
use Exception;

class ContactController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::with('company')->orderBy('contact_name', 'asc')->get();

        return $contact;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = ['company_id'=>'required',
                 'contact_name' =>'required',
                 'contact_number'=>'required',
                 'contact_email' =>'required|email',
                 'contact_designation'=>'required'
        ];

        $this->validate($request, $rules);
        try{
            $company = Company::where('company_id',$request->company_id)->first();
            
            $company->contacts()->firstOrCreate(['company_id'=> $company->company_id],
                                ['contact_name'=>$request->contact_name,
                                'contact_number'=>$request->contact_number,
                                'email'=>$request->contact_email,
                                'designation'=>$request->contact_designation]);
    
            return 'success';

        }catch(exception $e){
            return 'failed';
        }
       
        
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
        $rule = [
                'contact_name' =>'required',
                'contact_number'=>'required',
                'contact_email' =>'required|email',
                'contact_designation'=>'required'
        ];


        $this->validate($request, $rule);

        $contact = Contact::find($id);
        $contact->contact_name = $request->contact_name;
        $contact->contact_number = $request->contact_number;
        $contact->email = $request->contact_email;
        $contact->designation = $request->contact_designation;

        return $result = $contact->save()? 'success':'failed';
        

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
            $contact =Contact::find($id);
            $contact->delete();
            
            return 'success';
        }catch(Exception $e){
            return 'failed';
        }
       
    }
}

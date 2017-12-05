<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Company;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::with('company')->orderBy('contact_name', 'asc')->get();

        return view('pages.contact')->with('contact',$contact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        return $company;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = ['company_name'=>'required',
                 'contact_name' =>'required',
                 'contact_number'=>'required',
                 'contact_email' =>'required|email',
                 'contact_designation'=>'required'
        ];

        $this->validate($request, $rules);

        $company = Company::find($request->company_name);

        $company->contacts()->create(['company_id'=> $company->company_id,
                         'contact_name'=>$request->contact_name,
                         'contact_number'=>$request->contact_number,
                         'email'=>$request->contact_email,
                         'designation'=>$request->contact_designation
        ]);

        return redirect('/contact')-with('success','contact created successfully.');
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::with('company')->where('id',$id)->get();
        return view('pages.contact_edit.')->with('contact',$contact);
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
        $rule = ['company_name'=>'required',
                'contact_name' =>'required',
                'contact_number'=>'required|digit:10',
                'contact_email' =>'required|email',
                'contact_designation'=>'required'
        ];

        $this->validate($request, $rules);

        $company = Company::find($request->company_name);

        $contact = $company->contacts();
        $contact->company_id = $company->company_id;
        $contact->contact_name = $request->contact_name;
        $contact->contact_number = $request->contact_number;
        $contact->email = $request->contact_email;
        $contact->designation = $request->contact_designation;
        $contact->save();
        

        return redirect('/contact')->with('success','Update successful');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact =Contact::find($id);
        $contact_name = $contact->contact_name;
        $contact->delete();
        
        return redirect('/contact')->with('success', $contact_name.'has be deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::with(['contacts','industry'])->
                        withCount('projects')->orderBy('company_name','asc')->get();
        return $company;// view('pages.company');
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
        Commpany::create(['company_id'=>$request->company_id,
        'industry_id'=>$industry->id,
        'company_name'=>$request->company_name,
        'website'=>$request->website,
        'office_num'=>$request->office_number]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::with(['industry','contacts','projects'])->where('id',$id)->get();
        
        return view('company_show')->with('company',$company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('page.company_edit')->with('company',$company);
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
        'company_id'=>'required',
        'industry_id'=>'required',
        'website'=>'required|url',
        'office_number'=>'required|numeric'];

        $this->validate($request,$rule);
          
        $company = Company::find($id);
        $company->company_name = $request->compnay_name;
        $company->company_id - $request->company_id;
        $company->industry_id - $request->industry_id;
        $company->website - $request->website;
        $company->office_number - $request->office_number;
        $company->save();

        return redirect('/company')->withCookies('success','Upadte successfully');
        

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company_name = $company->company_name;
        $company->projects()->dissociate();
        $company->contacts()->dissociate();
        $company->delete();
        return redirect('/company')->with('success',$company_name.' has been deleted');
    }
}

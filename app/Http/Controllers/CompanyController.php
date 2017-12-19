<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    /**
     * provide authorization control in this controller
     */
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
        $company = Company::with(['contacts','industry'])->
                        withCount('projects')->orderBy('company_name','asc')->get();
        return $company;
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
        return $company;
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
        'office_number'=>'required|string'];

        $this->validate($request,$rule);
          
        $company = Company::find($id);
        $company->company_name = $request->company_name;
        $company->company_id =$request->company_id;
        $company->industry_id = $request->industry_id;
        $company->website = $request->website;
        $company->office_num = $request->office_number;
       
        return $result = $company->save()? $result = 'success': $result = 'failed';

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
            $company = Company::find($id);
            $company_name = $company->company_name;
            $company->projects()->where('company_id',$company->company_id)->delete();
            $company->contacts()->where('company_id',$company->company_id)->delete();
            $company->delete();
            return 'success';
        }catch(\Exception $e){

            return 'failed';
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Project;
use App\Company;
use App\Product;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        //$projects= $projects->sortByDesc('created_at');
        return $projects;//view('dashboard')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.project');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,rule());

        $industry = Industry::firstOrCreate(['name'=>$request->industry ]);
        //if (isEmpty($industry->companies()->find($request->id))){
           $company= $industry->companies()->firstOrCreate(['company_name'=>$request->company_name],
            ['company_id'=>$request->company_id],
            ['industry_id'=>$industry_id],
            ['website'=>$request->website],
            ['office_number'=>$request->office_number]
            );
        //}else 
       

        $projectStore = Project::create([
            'project_category'=>$request->project_category,
            'product'=>$product->id,
            'value'=>$request->value,
            'project_type'=>$request->project_type,
            'sales_stage'=>$request->sales_stage,
            'status'=>$request->status,
            'tender'=>$request->tender,
            'remark'=>$request->remark,
            'company_id'=>$company->company_id,
            'salesperson'=>$salesperson->salesperson_id
        ]);

        return reditect('/project')->with('success','A new project is added to the list');
    }

    /** validates the field related to creating a new project
     * @return \array of rules
     */
    private function rule(){
      return   ['company_name'=>'sometimes|required',
                'company_id'=>'sometimes|required',
                'industry'=>'sometimes|required',
                'website'=>'sometimes|required|url',
                'office_number'=>'sometimes|required|numeric',
                'contact_name'=>'sometimes|required',
                'contact_number'=>'sometimes|required',
                'contact_email'=>'sometimes|required',
                'contact_designation'=>'sometimes|nullable|string',
                'salesperson_id'=>'required',
                'project_category'=>'required',
                'product'=>'required',
                'value'=>'required|numeric',
                'project_type'=>'required',
                'sales_stage'=>'required',
                'Status'=>'required',
                'tender'=>'nullable|string',
                'remark'=>'nullable|string',
                'close_date'=>'nullable|date'
        ];      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
       return view('/project')->with('project',$project);
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
        $this->validate($request,rules());

        $project = Project::find($id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

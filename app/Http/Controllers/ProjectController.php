<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Salesperson;
use App\Company;
use App\Product;
use App\Project;
use App\Industry;

class ProjectController extends Controller
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
        $projects = Project::loadProjects();
        
        return view('pages.project')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::loadCompanyNames();
        $industry = Industry::all();
        $product = Product::all();

        $data=['company'=>$company,
                'industry'=>$industry,
                'product'=>$product];

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,$this->rule());
        //find or create new industry if not in db
        $industry = Industry::firstOrCreate(['industry'=>$request->industry ]);

        //find or create new comapny if not found in the db in case of new company entry
        $company= $industry->companies()->firstOrCreate(['company_id'=>$request->company_id,
                    'industry_id'=>$industry->id,
                    'company_name'=>$request->company_name,
                    'website'=>$request->website,
                    'office_num'=>$request->office_number]);

        //if new company is filled save contact attached to that company
        if($request->has('contact_name')){
            $company->contacts()->firstOrCreate(['company_id'=>$request->contact_id,
                'contact_name'=>$request->contact_name,
                'contact_number'=>$request->contact_number,
                'email'=>$request->contact_email,
                'designation'=>$request->contact_designation]);
        }

        //get product id
        $product = Product::find($request->product_name);
       
        //get salesperson 
        $salesPerson = Salesperson::find($request->salesperson_name);
        $salesPerson->projects()->create([
            'project_category'=>$request->project_category,
            'product'=>$product->id,
            'value'=>$request->value,
            'project_type'=>$request->project_type,
            'sales_stage'=>$request->sales_stage,
            'status'=>$request->status,
            'tender'=>$request->tender,
            'remark'=>$request->remark,
            'company_id'=>$company->company_id,
            'salesperson_id'=>$salesPerson->salesperson_id
        ]);

        return 'success';//reditect('/project')->with('success','A new project is added to the list');
    }

    /** validates the field related to creating a new project
     * @return \array of rules
     */
    private function rule(){
      return   ['company_name'=>'sometimes|required|string|max:255',
                'company_id'=>'sometimes|required|',
                'industry'=>'sometimes|required|',
                'website'=>'sometimes|required|url',
                'office_number'=>'sometimes|required|numeric',
                'contact_name'=>'sometimes|required',
                'contact_number'=>'sometimes|required',
                'contact_email'=>'sometimes|required',
                'contact_designation'=>'sometimes|nullable|string',
                'salesperson_name'=>'required',
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
        $project = Project::with('company.industy','company.contact','salesperson')->where('id',$id)->get(); 
        return $project;//view('pages.display_proj')->with('project', $project);
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
       return view('pages.project')->with('project',$project);
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

        $salesPerson = Salesperson::find($request->salesperson_name);

        $project = $salesPerson->projects()->where('id',$id)->get();
        $project->project_category = $request->project_category;
        $project->value =$request->value;
        $project->project_type = $request->project_type;
        $project->sales_stage = $request->sales_stage;
        $project->status = $request->status;
        $project->tender = $request->tender;
        $project->remark = $request->remark;
        $project->salesperson_id = $salesPerson->salesperson_id;
        $project->save();

        return redirect('/project')->with('success','Update was successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect('/project')->with('succes', 'Record has been deleted.');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Salesperson;
use App\Company;
use App\Contact;
use App\Product;
use App\Project;
use App\Industry;
use App\Deal;

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
        return $projects;
       
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
        try{
           
            $industry = $request->has('industry') ? Industry::firstOrCreate(['industry'=>$request->industry ]):null;

            //find or create new comapny if not found in the db in case of new company entry
            $company= Company::firstOrCreate(['company_id'=>$request->company_id],
                ['industry_id'=> !is_null($industry) ? $industry->id : '',
                'company_name'=>$request->company_name,
                'website'=>$request->website,
                'office_num'=>$request->office_number]);

            if ($request->has('contact_name')){
                Contact::firstOrCreate(['company_id'=>$company->company_id],
                    ['contact_name'=>$request->contact_name,
                    'contact_number'=>$request->contact_number,
                    'email'=>$request->contact_email,
                    'designation'=>$request->contact_designation]);

            }
            //get product id
            $product = Product::firstOrCreate(['product_name'=>$request->product]);
            
            //get salesperson 
            $salesPerson = Salesperson::firstOrCreate(['salesperson_id'=>$request->salesperson_id]);
            $project = Project::create([
                    'project_category'=>$request->project_category,
                    'product'=>$product->id,
                    'value'=>$request->value,
                    'project_type'=>$request->project_type,
                    'sales_stage'=>$request->sales_stage,
                    'status'=>$request->status,
                    'tender'=>$request->tender,
                    'remarks'=>$request->remark,
                    'close_at'=>$request->close_at,
                    'company_id'=>$company->company_id,
                    'salesperson_id'=>$salesPerson->salesperson_id
            ]);

            if($request->has('PO_number')){
                Deal::firstOrCreate(['po_num'=>$request->PO_number],
                    ['po_date'=>$request->PO_date,'project_id'=>$project->id]);    
            }    

            return 'success';//reditect('/project')->with('success','A new project is added to the list');

        }catch(\Exception $e ){
            return 'failed';
        }
       
    
      
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
                'salesperson_id'=>'required',
                'project_category'=>'required',
                'product'=>'required',
                'value'=>'required|numeric',
                'project_type'=>'required',
                'sales_stage'=>'required',
                'status'=>'required',
                'tender'=>'nullable|string',
                'remark'=>'nullable|string',
                'close_date'=>'nullable|string',
                'PO_number'=>'sometimes|required|string',
                'PO_date'=>'sometimes|required'
        ];      
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
        return $project;
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
        try{
            $this->validate($request,$this->rule());

            $salesPerson = Salesperson::where('salesperson_id',$request->salesperson_id)->first();

            $project = Project::find($id);
        
            $project->project_category = $request->project_category;
            $project->value =$request->value;
            $project->project_type = $request->project_type;
            $project->sales_stage = $request->sales_stage;
            $project->status = $request->status;
            $project->tender = $request->tender;
            $project->remarks = $request->remark;
            $project->close_at = $request->close_at;
            $project->salesperson_id = $salesPerson->salesperson_id;
            
            if($request->has('PO_number')){
                Deal::updateOrCreate(['project_id' => $project->id],
                ['po_num' => $request->PO_number,
                'po_date' => $request->PO_date]);
            }
            return $result = $project->save() ? $result ='success' : $result = 'failed';
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
            $project = Project::find($id);
            $project->deal()->where('project_id',$id)->delete();
            $project->delete();
            return 'success';
        }catch(\Exception $e){
            return 'failed';
        }
    }

}

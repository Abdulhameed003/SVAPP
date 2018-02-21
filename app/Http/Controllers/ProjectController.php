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
use Carbon\Carbon;

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
        return response()->json($projects);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all('id','company_name');
        $industry = Industry::all('id','industry');
        $product = Product::all('id','product_name');
        $salesperson = Salesperson::all('id','name','salesperson_id');
        $data=['company'=>$company,
                'industry'=>$industry,
                'product'=>$product,
                'salesperson'=>$salesperson];


        return response()->json($data);
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
           
            //$industry = $request->has('industry') ? Industry::firstOrCreate(['industry'=>$request->industry ]):null;

            //find or create new comapny if not found in the db in case of new company entry
            $company= Company::firstOrCreate(['company_name'=>$request->company_name],
                ['industry_id'=> $request->industry,//!is_null($industry) ? $industry->id : '',
                 'website'=>$request->website,
                'office_num'=>$request->office_number]);

            if ($request->has('contact_name')){
                Contact::firstOrCreate(['company_id'=>$company->id],
                    ['contact_name'=>$request->contact_name,
                    'contact_number'=>$request->contact_number,
                     'email'=>$request->contact_email,
                    'designation'=>$request->contact_designation]);

            }
            //get product id
            $product = Product::find($request->product);
            
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
                    'close_at'=>Carbon::parse($request->close_at)->format('Y-m-d'),
                    'start_date'=>Carbon::parse($request->start_date)->format('Y-m-d'),
                    'company_id'=>$company->id,
                    'salesperson_id'=>$salesPerson->salesperson_id
            ]);
            
            if($request->has('po_number')){
                Deal::firstOrCreate(['po_num'=>$request->po_number],
                    ['po_date'=>Carbon::parse($request->po_date)->format('Y-m-d'),'project_id'=>$project->id]);    
            }    

            return Project::getRecentlyAdded($project->id);

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
                'website'=>'sometimes|required',
                'office_number'=>'sometimes|required|numeric',
                'contact_name'=>'sometimes|required',
                'contact_number'=>'sometimes|required',
                'contact_email'=>'sometimes|required',
                'contact_designation'=>'sometimes|nullable|string',
                'salesperson_id'=>'required',
                'project_category'=>'sometimes|required',
                'product'=>'required',
                'value'=>'required|numeric',
                'project_type'=>'required',
                'sales_stage'=>'required',
                'tender'=>'nullable|string',
                'remark'=>'nullable|string',
                'close_date'=>'nullable',
                'start_date'=>'required',
                'po_number'=>'sometimes|required',
                'po_date'=>'sometimes|required'
        ];      
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
        $this->validate($request,$this->rule());
        try{
            $salesPerson = Salesperson::where('salesperson_id',$request->salesperson_id)->first();

            $project = Project::find($id);
        
            if ($request->has('project_category')){
                $project->project_category = $request->project_category;
            }
            $project->value =$request->value;
            $project->project_type = $request->project_type;
            $project->sales_stage = $request->sales_stage;
            $project->status = $request->status;
            $project->tender = $request->tender;
            $project->remarks = $request->remark;
            $project->close_at = Carbon::parse($request->close_at)->format('Y-m-d');
            $project->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $project->salesperson_id = $salesPerson->salesperson_id;
            
            if($request->has('po_number')){
                Deal::updateOrCreate(['project_id' => $project->id],
                ['po_num' => $request->po_number,
                'po_date' => Carbon::parse($request->po_date)->format('Y-m-d')]);
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

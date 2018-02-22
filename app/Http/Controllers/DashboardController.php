<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\ConfigureDB;
use App\Project;
use App\Product;
use App\Industry;
use Carbon\Carbon;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = [];
        $this->months = collect([
            ['month'=>'Jan','code'=>'01'],
            ['month'=>'Feb','code'=>'02'],
            ['month'=>'Mar','code'=>'03'],
            ['month'=>'Apr','code'=>'04'],
            ['month'=>'May','code'=>'05'],
            ['month'=>'Jun','code'=>'06'],
            ['month'=>'Jul','code'=>'07'],
            ['month'=>'Agu','code'=>'08'],
            ['month'=>'Sep','code'=>'09'],
            ['month'=>'Oct','code'=>'10'],
            ['month'=>'Nov','code'=>'11'],
            ['month'=>'Dec','code'=>'12']
        ]);

        $this->quarters = collect([
            ['qrt'=>'Q1','start'=>'01','end'=>'03'],
            ['qrt'=>'Q2','start'=>'04','end'=>'06'],
            ['qrt'=>'Q3','start'=>'07','end'=>'09'],
            ['qrt'=>'Q4','start'=>'10','end'=>'12'],
        ]);

        
        $dbToConnect = ConfigureDB::ConfigureDBConnection('db_'.auth()->User()->company_id);
        DB::connection($dbToConnect);

       
       $dashboard = ['totalWonCase'=>$this->totalWonCase(),
                    'totalRenewals'=>$this->totalRenewal(),
                    'totalNewsales'=>$this->totalNewSales(),
                    'wonOpp'=>$this->wonOpp(),
                    'quarterWonLost'=>$this->quarterWonLost(),
                    'salesByProduct'=>$this->salesByProuct(),
                    'salesByIndustry'=>$this->salesByIndustry(),
                    'totalCloseOpp'=>$this->totalCloseOpp(),
                    'frontdash' => $this->frontdash()
        ];

        return $dashboard;
    }

    private function totalWonCase(){
        $newSalesSum = Project::where([['project_category','Deal'],['project_type','New Sale'],['start_date','>=',Carbon::now()->startOfYear()]])->sum('value');
        $renewalSum = Project::where([['project_category','Deal'],['project_type','Renewal'],['start_date','>=',Carbon::now()->startOfYear()]])->sum('value');
        return [['label'=>'Total New Sales','value'=>$newSalesSum],
                ['label'=>'Total Renewals','value'=>$renewalSum]];
    }

    private function totalRenewal(){
        $totalRenewal = [];
        $category =[];
        $data = [];

        $products = Product::all('id','product_name');
        foreach($products as $product){
            $value_sum= Project::where([['project_type','Renewal'],['start_date','>=',Carbon::now()->startOfYear()]])
                    ->where('product',$product->id)
                    ->sum('value');
            $category = array_prepend($category,['label'=>$product->product_name]);
            $data = array_prepend($data,['value'=>$value_sum]);
        }
        $totalRenewal = ['category'=>array_reverse($category),'data'=>array_reverse($data)];
        return $totalRenewal;
        
    }

    private function totalNewsales(){
        $totalNewSales = [];
        $category =[];
        $data = [];

        $products = Product::all('id','product_name');
        foreach($products as $product){
            $value_sum= Project::where([['project_type','New Sale'],['start_date','>=',Carbon::now()->startOfYear()],['product',$product->id]])
                ->sum('value');
            $category = array_prepend($category,['label'=>$product->product_name]);
            $data= array_prepend($data,['value'=>$value_sum]);
        }
        $totalNewSales = ['category'=>array_reverse($category),'data'=>array_reverse($data)];
        return $totalNewSales;
    }

    private function wonOpp(){
        $comparison = [];
        $category = [];
        $totalOpp = [];
        $wonOpp = [];

        $startdate = Carbon::now()->format('Y');
        foreach($this->months as $month){
            $value_sum_wonOpp = Project::where('project_category','Deal')
                    ->whereYear('start_date',$startdate)
                    ->whereMonth('start_date',$month['code'])
                    ->sum('value');
            $value_sum_totalOpp = Project::whereYear('start_date',$startdate)
                    ->whereMonth('start_date',$month['code'])
                    ->sum('value');
            $category = array_prepend($category,['label'=>$month['month']]);
            $totalOpp = array_prepend($totalOpp,['value'=>$value_sum_totalOpp]);
            $wonOpp = array_prepend($wonOpp,['value'=>$value_sum_wonOpp]); 
            
        }
        $comparison = ['category'=>array_reverse($category), 'data'=>['totalOpp'=>array_reverse($totalOpp),'wonOpp'=>array_reverse($wonOpp)]];

        return $comparison;
    }

    private function quarterWonLost(){
        $quaterlyWonLost = [];
        $category=[];
        $won=[];
        $lost =[];

        $startdate = Carbon::now()->format('Y');
        foreach($this->quarters as $quarter){
            $value_sum_wonCase = Project::where('project_category','Deal')
                    ->whereYear('start_date',$startdate)
                    ->whereMonth('start_date','>=',$quarter['start'])
                    ->whereMonth('start_date','<=',$quarter['end'])
                    ->sum('value');
            $value_sum_lostCase = Project::where('project_category','Lost Case')
                    ->whereYear('start_date',$startdate)
                    ->whereMonth('start_date','>=',$quarter['start'])
                    ->whereMonth('start_date','<=',$quarter['end'])
                    ->sum('value');

             $category = array_prepend($category,['label'=>$quarter['qrt']]);
             $won = array_prepend($won,['value'=>$value_sum_wonCase]);
             $lost = array_prepend($lost,['value'=>$value_sum_lostCase]);
            
        }
        $quaterlyWonLost = ['category'=>array_reverse($category),'data'=>['won'=>array_reverse($won),'lost'=>array_reverse($lost)]];
        return $quaterlyWonLost;
    }

    private function salesByProuct(){
        $salesByProduct = [];
        $startYear = Carbon::now()->format('Y');
        $products = Product::all('id','product_name');
        foreach($products as $product){
            $value_sum= Project::where([['project_category','Deal'],
                                        ['project_category','Lead'],
                                        ['product',$product->id]])->whereYear('start_date',$startYear)
                      ->sum('value');
            $salesByProduct = array_prepend($salesByProduct,['label'=>$product->product_name,'value'=>$value_sum]);
        }
        
        return $salesByProduct;

    }
    
    private function salesByIndustry(){
        $salesByIndustry = [];
        $startYear = Carbon::now()->format('Y');

        $industries = Industry::all('id','industry');
        foreach($industries as $industry){
            $value_sum= Project::with('company')->where([['project_category','Deal'],
                                        ['project_category','Lead'],
                                        ['product',$industry->id]])->whereYear('start_date','=',$startYear)
                      ->sum('value');
            $salesByIndustry = array_prepend($salesByIndustry,['label'=>$industry->industry,'value'=>$value_sum]);
        }
        
        return $salesByIndustry;
    }

    private function totalCloseOpp(){
        $quaterlyClose = [];
        $category =[];
        $deal = [];
        $lead = [];
        $startdate = Carbon::now()->format('Y');
        foreach($this->quarters as $quarter){
            $deal_close_count = Project::where('project_category','Deal')
                    ->whereYear('start_date',$startdate)
                    ->whereMonth('close_at','>=',$quarter['start'])
                    ->whereMonth('close_at','<=',$quarter['end'])
                    ->count();
            $lead_close_count = Project::where('project_category','Lead')
                    ->whereYear('start_date',$startdate)
                    ->whereMonth('close_at','>=',$quarter['start'])
                    ->whereMonth('close_at','<=',$quarter['end'])
                    ->count();

            $category = array_prepend($category,['label'=>$quarter['qrt']]);
            $deal = array_prepend($deal,['value'=>$deal_close_count]);
            $lead = array_prepend($lead,['value'=>$lead_close_count]); 
            
        }
        $quaterlyClose =['category'=>array_reverse($category), 'data'=>['deal'=>array_reverse($deal),'lead'=>array_reverse($lead)]];

        return array_reverse($quaterlyClose);
    }

    private function frontdash(){
        $frontDash = [];
        $startYear = Carbon::now()->format('Y');
        $target = 200000; // for initial phase we hardcode the target value.

        $project = Project::whereYear('start_date',$startYear)->get();
        $progressTT = $project->where('project_category','Deal')->sum('value');
        $totalOppVal = $project->where('project_category','Lead')->sum('value');
        $totalOppCount = $project->where('project_category','Lead')->count();
        $totalWonVal = $progressTT;
        $totalWonCount = $project->where('project_category','Deal')->count();
        $totalLostVal = $project->where('project_category','Lost Case')->sum('value');
        $totalLostCount = $project->where('project_category','Lost Case')->count();

        return [['Target'=>$target],
                ['progressToTgt'=>$progressTT],
                ['totalOppVal'=>$totalOppVal],
                ['totalOppCount'=>$totalOppCount],
                ['totalWonVal'=>$totalWonVal],
                ['totalWonCount'=>$totalWonCount],
                ['totalLostVal'=>$totalLostVal],
                ['totalLostCount'=>$totalLostCount]
        ];
    }
} 

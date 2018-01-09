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

        //$totalWonCase = $this->totalWonCase();
        //$totalRenewals = $this->totalRenewal();
       //$totalNewsales = $this->totalNewsales();
        $wonOp = $this->quarterWonLost();
        return $wonOp;
        $dashboard = ['totalWonCase'=>$this->totalWonCase(),
                    'totalRenewals'=>$this->totalRenewal(),
                    'totalNewsales'=>$this->totalNewSales(),
                    'wonOpp'=>$this->wonOpp(),
                    'quarterWonLost'=>$this->quarterWonLost(),
                    'salesByProduct'=>$this->salesByProuct(),
                    'slaesByIndustry'=>$this->salesByIndustry(),
                    'totalCloseOpp'=>$this->totalCloseOpp()
        ];

        return $response->json($dashboard);
    }

    private function totalWonCase(){
        $newSalesSum = Project::where([['project_category','Deal'],['project_type','New Sales'],['start_date','>=',Carbon::now()->startOfYear()]])->sum('value');
        $renewalSum = Project::where([['project_category','Deal'],['project_type','Renewals'],['start_date','>=',Carbon::now()->startOfYear()]])->sum('value');
        return [['Total New Sales'=>$newSalesSum],['Total Renewals'=>$renewalSum]];
    }

    private function totalRenewal(){
        $totalRenewal = [];
        $products = Product::all('id','product_name');
        foreach($products as $product){
            $value_sum= Project::where([['project_type','Renewals'],['start_date','>=',Carbon::now()->startOfYear]])
                    ->where('product',$product->id)
                    ->sum('value');
            $totalRenewal = array_prepend($totalRenewal,['label'=>$product->product_name,'value'=>$value_sum]);
        }
        
        return $totalRenewal;
        
    }

    private function totalNewsales(){
        $totalNewSales = [];
        $products = Product::all('id','product_name');
        foreach($products as $product){
            $value_sum= Project::where([['project_type','New Sales'],['start_date','>=',Carbon::now()->startOfYear()],['product',$product->id]])
                ->sum('value');
            $totalNewSales = array_prepend($totalNewSales,['label'=>$product->product_name,'value'=>$value_sum]);
        }
        
        return $totalNewSales;
    }

    private function wonOpp(){
        $comparison = [];
        $startdate = Carbon::now()->subYear()->format('Y');
        foreach($this->months as $month){
            $value_sum_wonOpp = Project::where('project_category','Deal')
                    ->whereYear('start_date',$startdate)
                    ->whereMonth('start_date',$month['code'])
                    ->sum('value');
            $value_sum_totalOpp = Project::whereYear('start_date',$startdate)
                    ->whereMonth('start_date',$month['code'])
                    ->sum('value');
            $comparison = array_prepend($comparison,['label'=>$month['month'],'value'=>['totalOpp'=>$value_sum_totalOpp,'wonOpp'=>$value_sum_wonOpp]]); 
            
        }

        return $comparison;
    }

    private function quarterWonLost(){
        $quaterlyWonLost = [];
        $startdate = Carbon::now()->subYear()->format('Y');
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

            $quaterlyWonLost = array_prepend($quaterlyWonLost,['label'=>$quarter['qrt'],'value'=>['won'=>$value_sum_wonCase,'wonOpp'=>$value_sum_lostCase]]); 
            
        }
        
    }

    private function salesByProuct(){
        $salesByProduct = [];
        $products = Product::all('id','product_name');
        foreach($products as $product){
            $value_sum= Project::where([['project_category','Deal'],
                                        ['project_category','Lead'],
                                        ['product',$product->id]])
                      ->sum('value');
            $salesByProduct = array_prepend($salesByProduct,['label'=>$product->product_name,'value'=>$value_sum]);
        }
        
        return $salesByProduct;

    }
    
    private function salesByIndustry(){
        $salesByIndustry = [];
        $industries = Industry::all('id','industry');
        foreach($industries as $industry){
            $value_sum= Project::with('company')->where([['project_category','Deal'],
                                        ['project_category','Lead'],
                                        ['product',$product->id]])
                      ->sum('value');
            $salesByIndustry = array_prepend($salesByIndustry,['label'=>$industry->industry,'value'=>$value_sum]);
        }
        
        return $salesByIndustry;
    }

    private function totalCloseOpp(){
        $quaterlyClose = [];
        $startdate = Carbon::now()->subYear()->format('Y');
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

            $quaterlyClose = array_prepend($quaterlyWonLost,['label'=>$quarter['qrt'],
                                    'value'=>['deal'=>$value_sum_wonCase,'lead'=>$value_sum_lostCase]]); 
            
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\ConfigureDB;
use App\Project;
use App\Product;
use App\Deal;
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

        $arr = [];
        $dbToConnect = ConfigureDB::ConfigureDBConnection('db_'.auth()->User()->company_id);
        DB::connection($dbToConnect);
        //$totalWonCase = $this->totalWonCase();
       //$totalRenewals = $this->totalRenewal();
       //$totalNewsales = $this->totalNewsales();
        $wonOp = $this->wonOp();
        return $wonOp;
    }

    private function totalWonCase(){
        $newSalesSum = Project::where([['project_category','Deal'],['project_type','New Sales'],['start_date','>=',Carbon::now()->startOfYear()]])->sum('value');
        $renewalSum = Project::where([['project_category','Deal'],['project_type','Renewals'],['start_date','>=',Carbon::now()->startOfYear()]])->sum('value');
        return [['Total New Sales'=>$newSalesSum],['Total Renewals'=>$renewalSum]];
    }

    private function totalRenewal(){
        $totalRenewal = [];
        $products = Product::all('id','product_name');
        $renewals = Project::where([['project_type','Renewals'],['start_date','>=',Carbon::now()->startOfYear]])->get();
        foreach($products as $product){
            $value_sum= $renewals->where('product',$product->id)->sum('value');
            $totalRenewal = array_prepend($totalRenewal,['label'=>$product->product_name,'value'=>$value_sum]);
        }
        
        return $totalRenewal;
        
    }

    private function totalNewsales(){
        $totalNewSales = [];
        $products = Product::all('id','product_name');
        $newsales = Project::where([['project_type','New Sales'],['start_date','>=',Carbon::now()->startOfYear()]])->get();
        foreach($products as $product){
            $value_sum= $newsales->where('product',$product->id)->sum('value');
            $totalNewSales = array_prepend($totalNewSales,['label'=>$product->product_name,'value'=>$value_sum]);
        }
        
        return $totalNewSales;
    }

    private function wonOpp(){
        $wonOpp = [];
        $totalOpp = [];
    
        $startdate = Carbon::now()->subYear()->format('Y');
        foreach($this->months as $month){
            $value_sum_wonOpp = Project::where('project_category','Deal')->whereYear('start_date',$startdate)->whereMonth('start_date',$month['code'])->sum('value');
            $value_sum_totalOpp = Project::whereYear('start_date',$startdate)->whereMonth('start_date',$month['code'])->sum('value');
            $wonOpp = array_prepend($wonOpp,['label'=>$month['month'],'value'=>$value_sum_wonOpp]); 
        }

        return array_sort($wonOpp);
    }

    private function totalOpp(){
        

        
    }

}

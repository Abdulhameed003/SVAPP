<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ConfigureDB;
use App\Project;
use App\Deal;

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
        $dbToConnect = ConfigureDB::ConfigureDBConnection('db_'.auth()->User()->company_id);
        DB::connection($dbToConnect);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $totalWonCase = totalWonCase();

        return 'sum';
    }

    private function totalWonCase(){
        $newSalesSum = Project::where([['project_category','Deal'],['project_type','New Sales']])->sum('value');
        $renewalSum = Project::where([['project_category','Deal'],['project_type','Renewals']])->sum('value');
        return [['Total New Sales'=>$newSalesSum],['Total Renewals'=>$renewalsSum]];
    }

    private function totalRenewal(){
        $renewal = Project::with('product')->where('project_type','Renewals')->pluck('product.product_name','value');

    }
}

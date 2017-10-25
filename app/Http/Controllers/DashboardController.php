<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ConfigureDB;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbToConnect = ConfigureDB::ConfigureDBConnection('db_'.auth()->User()->company_id);
        DB::connection($dbToConnect);

        return view('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('dashboard',['page'=> view('dashboard.dashboardPage')]);
    }
    /**
     * Show the application dashboard with page specified.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardPage($pageName)
    {
        if($pageName==""){
            return view('dashboard',['page'=> view('dashboard.dashboardPage')]);
        }
        else{
            return view('dashboard',['page'=> view('dashboard.dashboardAddPage')]);
        }
        
    }
}

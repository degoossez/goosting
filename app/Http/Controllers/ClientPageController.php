<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientPageController extends Controller
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
        return view('dashboard');
    }
    /**
     * Show the application dashboard with addPage info.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPage()
    {
        return view('dashboard.dashboardAddPage');
    }
}

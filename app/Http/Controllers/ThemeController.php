<?php

namespace App\Http\Controllers;

use App\theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(theme $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, theme $theme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(theme $theme)
    {
        //
    }
    /**
    * Send the addTheme html.
    *
    * @return \Illuminate\Http\Response
    */
    public function addTheme()
    {
        return view('dashboard.dashboardAddTheme');
    }
    /**
    * Get all themes created by the user and send it to the sidebar in html list items (li)
    *
    * @return \Illuminate\Http\Response
    */
    public function loadThemesList()
    {
        $htmlresult = "<li>
        <a href='#' onclick='loadAddTheme();'>Create new theme<i class='fas fa-plus-circle icon-right'></i></a>
        
        </li>";

        $userThemes = \App\theme::where('userid', Auth::user()->id)->get(); // model or null
        if (!$userThemes) {
            // No user themes
            return ""; //empty list so return an empty string
        }
        else{            
            foreach($userThemes as $ut){
                $htmlresult .= '
                <li>
                <a href="/dashboard/edittheme/'.$ut->id.'" id="editTheme'.$ut->id.'">'.$ut->name.'<i class="far fa-edit icon-right"></i></a>
                </li>';
            }
            return $htmlresult;
        }
        
    }
    /**
    * Get all themes created by the user and send it in a list
    *
    * @return \Illuminate\Http\Response
    */
    public function getAllThemes()
    {
        $htmlresult = "<li>
        <a href='#' onclick='loadAddTheme();'>Create new theme<i class='fas fa-plus-circle icon-right'></i></a>
        
        </li>";
        //$userThemes = \App\theme::select('id','name')->where('userid', 1)->get(); // model or null
        $userThemes = \App\theme::select('id','name')->where('userid', Auth::user()->id)->get(); // model or null
        if (!$userThemes) {
            // No user themes
            return ""; //empty list so return an empty string
        }
        else{            
            return json_encode($userThemes);
        }
        
    }
    /**
    * Send the editTheme html IF the correct user is accessing it
    * default value for new is false
    * @return \Illuminate\Http\Response
    */
    public function editTheme($theme_id)
    {          
        $themeInfo = \App\theme::where('id', $theme_id)->where('userid',Auth::user()->id)->get(); // model or null to verify if user is owner of this page
        if(!$themeInfo){
            return redirect('dashboard'); //TODO make an error displaying on the page in a top bar style (see bootstrap)
        }
        else{
            $pageData = $themeInfo[0];
            return view('dashboard.dashboardEditTheme')->with(compact('pageData')); 
        } 
    }
}

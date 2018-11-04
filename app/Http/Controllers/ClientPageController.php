<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Send the addPage html.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPage()
    {
        return view('dashboard.dashboardAddPage');
    }
    /**
     * store the addPage html.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail=$request->summernoteInput;
        $title=$request->pagetitle;
        $summary=$request->summary;
        
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
 
        $images = $dom->getelementsbytagname('img');
 
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
 
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
 
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);

            //TODO: find clean solution for accessing images
            $image_name= "/../".$image_name;
 
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }
 
        $detail = $dom->savehtml();
        //Save the page in the database
        $summernote = new \App\Userpage;
        $summernote->content = $detail;
        $summernote->title = $title;
        $summernote->summary = $summary;
        $summernote->save();
        $data_id = $summernote->id;
        //link the new page with the user
        $userpagelink = new \App\userpagesuser;
        $userpagelink->userpages_id = $data_id;
        $userpagelink->user_id = Auth::user()->id;
        $userpagelink->save();

        return redirect('dashboard/editpage/' . $data_id);
    }
    /**
     * update the addPage html.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateOrPublish(Request $request)
    {
        if($request->submitButton == "update"){
            $page_id=$request->page_id;
            $userpagelink = \App\userpagesuser::where('userpages_id', $page_id)->first(); // model or null to verify if user is owner of this page
            if (!$userpagelink) {
                // User has no page with this ID linked to it
                return redirect('dashboard'); //TODO make an error displaying on the page in a top bar style (see bootstrap)
            }
            else{
                $detail=$request->summernoteInput;
                $title=$request->pagetitle;
                $summary=$request->summary;
                
                $dom = new \domdocument();
                $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
         
                $images = $dom->getelementsbytagname('img');
         
                foreach($images as $k => $img){
                    $data = $img->getattribute('src');
         
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
         
                    $data = base64_decode($data);
                    $image_name= time().$k.'.png';
                    $path = public_path() .'/'. $image_name;
                    file_put_contents($path, $data);
        
                    //TODO: find clean solution for accessing images
                    $image_name= "/../".$image_name;
         
                    $img->removeattribute('src');
                    $img->setattribute('src', $image_name);
                }
         
                $detail = $dom->savehtml();
        
                $userpage = new \App\Userpage;
                $userpage->update_page($page_id,$detail,$title,$summary);
        
                return redirect('dashboard/editpage/' . $page_id);
            }     
        }
        elseif($request->submitButton == "publish"){
            $userpage = new \App\Userpage;
            $userpage->publish_page($request->page_id);

            return redirect('dashboard/editpage/' . $request->page_id);
        }
           

    }
    /**
     * show the addPage html.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }
    /**
     * Send the editPage html IF the correct user is accessing it
     * default value for new is false
     * @return \Illuminate\Http\Response
     */
    public function editPage($page_id)
    {  

        $userpagelink = \App\userpagesuser::where('userpages_id', $page_id)->first(); // model or null to verify if user is owner of this page
        if (!$userpagelink) {
            // User has no page with this ID linked to it
            return redirect('dashboard'); //TODO make an error displaying on the page in a top bar style (see bootstrap)
        }
        else{
            $pageInfo = \App\Userpage::where('id',$page_id)->get();
            if(!$pageInfo){
                return redirect('dashboard'); //TODO make an error displaying on the page in a top bar style (see bootstrap)
            }
            else{
                $pageData = $pageInfo[0];
                return view('dashboard.dashboardEditPage')->with(compact('pageData')); 
            }
        }        
    }
    /**
     * Publish the page to a live URL "websiteurl"/browse/{username}/{pageTitle}
     * 
     * @return \Illuminate\Http\Response
     */
    public function publishUserPage(Request $request)
    {

    }
    /**
     * Get all pages created by the user and send it to the sidebar in html list items (li)
     *
     * @return \Illuminate\Http\Response
     */
    public function loadPagesList()
    {
        $htmlresult = "<li>
        <a href='#' onclick='loadAddPage();'>Create new page<i class='fas fa-plus-circle icon-right'></i></a>
        
        </li>";
        $userPages = \App\userpagesuser::where('user_id', Auth::user()->id)->select('userpages_id')->get(); // model or null
        if (!$userPages) {
            // User has no page with this ID linked to it
            return ""; //empty list so return an empty string
        }
        else{
            
            foreach($userPages as $up){
                $pageInfo = \App\Userpage::where('id',$up->userpages_id)->select('title')->get();
                $htmlresult .= '
                <li>
                <a href="/dashboard/editpage/'.$up->userpages_id.'" id="editPage'.$up->userpages_id.'">'.$pageInfo[0]->title.'<i class="far fa-edit icon-right"></i></a>
                </li>';
            }
            return $htmlresult;
        }
        
    }
}

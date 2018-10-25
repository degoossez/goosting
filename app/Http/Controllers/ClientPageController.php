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
        $summernote = new \App\Userpage;
        $summernote->content = $detail;
        $summernote->save();
        $data_id = $summernote->id;
        return view('dashboard',['page'=> view('dashboard.dashboardAddPage',compact('summernote'),['data_id'=> $data_id]),'submittedContent'=>view('dashboard.dashboardShowPage',compact('summernote'))]);
    }
    /**
     * show the addPage html.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }
}

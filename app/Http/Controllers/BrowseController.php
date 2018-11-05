<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrowseController extends Controller
{
    /**
    * Shows the requested user page
    * 
    * @return \Illuminate\Http\Response
    */
    public function displayPage($userName,$pageName)
    {
        $userid = \App\User::select('id')->where('name', $userName)->first();
        if($userid){
            $pageIDs = \App\userpagesuser::select('userpages_id')->where('user_id',$userid->id)->get();
            if($pageIDs){
                $pagenamespace = str_replace("_"," ",$pageName);
                $pageInfo = \App\Userpage::whereIn('id',$pageIDs)->where('title','like','%'.$pagenamespace.'%')->get();
                foreach($pageInfo as $pi){
                    $dbTitle = strip_tags($pi->title);
                    if($dbTitle == $pagenamespace){
                        $pageData = $pi;
                        return view('browse.browseShowPage',['title'=>$pagenamespace])->with(compact('pageData')); 
                    }
                }
            }
        }
        //No match found so throw error 404
        abort(404);  
    }
}

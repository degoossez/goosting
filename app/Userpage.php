<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'title', 'summary',
    ];

    /**
     * Update the userpage with the new data
     */
    public function update_page($page_id,$detail,$title,$summary){
        $current_data = Userpage::find($page_id);
        $current_data->content = $detail;
        $current_data->title = $title;
        $current_data->summary = $summary;

        $current_data->save();
    }
    /**
     * Set the status of the page as published
     */
    public function publish_page($page_id){
        $userpage = Userpage::find($page_id);
        $userpage->status = "published";
        $userpage->save();
    }
}

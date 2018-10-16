<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTags extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blog_id', 'tag_id', 
    ];    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blog";

    public function category()
    {
        return $this->belongsTo(CategoryBlog::class,'categry_id');
    }
}

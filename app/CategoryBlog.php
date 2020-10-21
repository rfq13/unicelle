<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}

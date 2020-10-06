<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "member";
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(userMember::class, "member_id");
    }
}

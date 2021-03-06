<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberCustom extends Model
{
    protected $table = "member_custom";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership_user_log extends Model
{
    protected $table = "membership_user_log";
    protected $guarded = [];

    public function membership()
    {
        return $this->belongsTo(Member::class, "member_id");
    }

    public function user()
    {
    }
}

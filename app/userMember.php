<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userMember extends Model
{
    protected $table = "user_member";

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function member()
    {
        return $this->belongsTo(Member::class, "member_id");
    }
}

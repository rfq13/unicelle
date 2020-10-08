<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class physician_verificationModel extends Model
{
    protected $table = "physician_verification";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

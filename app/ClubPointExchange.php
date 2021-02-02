<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClubPointExchange extends Model
{
	protected $table = 'club_point_exchange';
	
    public function user(){
    	return $this->belongsTo(user::class);
    }
    public function voucher(){
    	return $this->belongsTo(CouponVoucher::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    protected $table = "voucher_usage";
    public function voucher()
    {
        return $this->belongsTo(CouponVoucher::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

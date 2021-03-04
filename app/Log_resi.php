<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Log_resi extends Model
{
    protected $table='log_resi';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}

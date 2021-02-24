<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Admin_log extends Model
{
    protected $table='admin_logs';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}

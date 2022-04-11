<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function rel_to_orderDetails()
    {
        return $this->belongsTo(BillingDetail::class, 'user_id');
    }
    public function rel_to_orderProducts()
    {
        return $this->hasMany(OrderedProduct::class, 'order_id');
    }
   
   
    
}

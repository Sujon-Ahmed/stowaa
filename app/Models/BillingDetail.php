<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class BillingDetail extends Model
{
    use HasFactory;
    public function rel_to_city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function rel_to_country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function rel_to_orderProduct()
    {
        return $this->hasMany(OrderedProduct::class, 'order_id');
    }
}

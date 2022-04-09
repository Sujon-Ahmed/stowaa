<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;
    public function rel_to_product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

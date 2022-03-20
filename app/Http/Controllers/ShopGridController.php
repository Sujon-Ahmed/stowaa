<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopGridController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(9);
        return view('frontend.shop_grid', [
            'products'=>$products,
            'categories'=>$categories,
        ]);
    }
}

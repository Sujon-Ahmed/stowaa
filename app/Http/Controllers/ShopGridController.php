<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopGridController extends Controller
{
    public function index()
    {
        $total_products = Product::all()->count();
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->paginate(9);
        return view('frontend.shop_grid', [
            'products' => $products,
            'categories' => $categories,
            'total_products' => $total_products,
        ]);
    }

    public function filter_category_product($id)
    {
        $total_products = Product::all()->count();
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->where('category_id', $id)->paginate(9);
        return view('frontend.shop_grid', [
            'products' => $products,
            'categories' => $categories,
            'total_products' => $total_products,
        ]);
    }

  

}

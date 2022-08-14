<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopGridController extends Controller
{
    public function index(Request $request)
    {
        $total_products = Product::all()->count();
        $categories = Category::all();
        $sort_text = '';
        if ($request->sort != null) {
            $sort = $request->sort;
            if ($sort === 'default') {
                $sort_text = 'default';
                $products = Product::orderBy('id', 'desc')->paginate(9);
            } else if ($sort === 'sortNewest') {
                $sort_text = 'sortNewest';
                $products = Product::orderBy('created_at', 'desc')->paginate(9);
            } else if ($sort === 'sortOldest') {
                $sort_text = 'sortOldest';
                $products = Product::orderBy('created_at', 'asc')->paginate(9);
            } else if ($sort === 'sortPriceASC') {
                $sort_text = 'sortPriceASC';
                $products = Product::orderBy('product_price', 'asc')->paginate(9);
            } else if ($sort === 'sortPriceDESC') {
                $sort_text = 'sortPriceDESC';
                $products = Product::orderBy('product_price', 'desc')->paginate(9);
            }

        } else {
            $products = Product::orderBy('id', 'desc')->paginate(9);
        }

        return view('frontend.shop_grid', [
            'sort_text' => $sort_text,
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

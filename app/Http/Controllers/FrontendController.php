<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $all_categories = Category::all();
        $all_products = Product::take(6)->get();
        return view('frontend.index', [
            'all_categories'=>$all_categories,
            'all_products'=>$all_products,
        ]);
    }

    public function product_details($product_id)
    {
        $product_info = Product::find($product_id);
        // echo $product_info->category_id;
        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=',  $product_id)->get();
        // echo $related_products;
        return view('frontend.product_details', [
            'product_info'=>$product_info,
            'related_products'=>$related_products,
        ]);
        return back();
    }

    public function customer_account()
    {
        return view('frontend.customer_account');
    }

    public function customer_account_update(Request $request)
    {
        Customer::find(Auth::guard('customer')->id())->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);
        return back();
    }

    public function wishlist()
    {
        return view('frontend.wishlist');
    }

}

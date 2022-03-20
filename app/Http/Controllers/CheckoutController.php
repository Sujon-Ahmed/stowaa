<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Country;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $sub_total = 0;
        $carts = Cart::where('user_id', Auth::guard('customer')->id())->get();
        $countries = Country::all();
        foreach ($carts as $cart) {
            $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
        }
        return view('frontend.checkout', [
            'sub_total'=>$sub_total,
            'countries'=>$countries,
        ]);
    }

    public function getCity(Request $request)
    {
        // $country_id = $request->country_id;
        $cities = City::where('country_id', $request->country_id)->get();
        $str_to_send = '<option value="">Select a country&hellip;</option>';
        foreach ($cities as $city) {
            $str_to_send .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        } 
        echo $str_to_send;
    }

    // orders insert
    public function order_insert(Request $request)
    {
        $order_id = Order::insertGetId([
            'user_id'=>Auth::guard('customer')->id(),
            'sub_total'=>$request->sub_total,
            'discount'=>$request->discount,
            'delivery_charge'=>$request->delivery_charge,
            'payment_method'=>$request->payment_method,
            'created_at'=>Carbon::now(),
        ]);

        BillingDetail::insert([
            'order_id'=>$order_id,
            'user_id'=>Auth::guard('customer')->id(),
            'name'=>$request->name,
            'email'=>$request->email,
            'company'=>$request->company,
            'phone'=>$request->phone,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
            'address'=>$request->address,
            'notes'=>$request->notes,
            'created_at'=>Carbon::now(),
        ]);

        $carts = Cart::where('user_id', Auth::guard('customer')->id())->get();
        foreach ($carts as $cart) {
            OrderedProduct::insert([
                'order_id'=>$order_id,
                'product_id'=>$cart->product_id,
                'quantity'=>$cart->quantity,
                'price'=>$cart->rel_to_product->after_discount,
                'created_at'=>Carbon::now(),
            ]);
        }
        return redirect()->route('ordered_confirm')->with('ordered_confirm', 'your order has been placed!');
    }

    public function order_confirm()
    {
        $carts = Cart::where('user_id', Auth::guard('customer')->id())->get();
        foreach ($carts as $cart) {
            Cart::find($cart->id)->delete();
            Product::find($cart->product_id)->decrement('quantity', $cart->quantity);
        }   
        return view('frontend.ordered_confirm');
    }
}

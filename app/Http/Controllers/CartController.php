<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart_insert(Request $request)
    {
        // $cart_id = Cart::where('product_id', $request->product_id)->where('user_id', Auth::id())->get();

        // foreach($cart_id as $cart) {
            
        //     if($cart_id !== '') {
        //         Cart::find($cart->id)->update([
        //             'quantity'=>$request->quantity + $cart->quantity,
        //         ]);
        //         return back()->with('cart_added', 'Cart Updated Successfully'); 
        //     }
        // }

        if (Cart::where('user_id', Auth::guard('customer')->id())->where('product_id', $request->product_id)->exists()) {
            Cart::where('product_id', $request->product_id)->increment('quantity', $request->quantity);
            // Product::where('id', $request->product_id)->decrement('quantity', $request->quantity);

            return back()->with('cart_added', 'Cart Add Successfully');

        } else {
            Cart::insert([
                'user_id'=>Auth::guard('customer')->id(),
                'product_id'=>$request->product_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('cart_added', 'Cart Added Successfully');
        }
    }

    // cart remove
    public function cart_remove($id)
    {
        Cart::find($id)->delete();
        return back();
    }

    // cart page
    public function cart(Request $request)
    {
        $coupon_code = $request->coupon_code;
        $message = null;
        if ($coupon_code == '') {
            $discount = 0;
        } else {
            if (Coupon::where('coupon_code', $coupon_code)->exists()) {
                if (Carbon::now()->format('Y-m-d') > Coupon::where('coupon_code', $coupon_code)->first()->validity) {
                    $message = "Expired Coupon Code!";
                    $discount = 0;
                } else {
                    $discount = Coupon::where('coupon_code', $coupon_code)->first()->discount;
                }
            } else {
                $message = "Invalid Coupon Code!";
                $discount = 0;
            }
        }

        $carts = Cart::where('user_id', Auth::guard('customer')->id())->get();
        return view('frontend.cart', [
            'carts'=>$carts,
            'discount'=>$discount,
            'coupon_code'=>$coupon_code,
            'message'=>$message,
        ]);
    }

    public function cart_update(Request $request)
    {
        foreach ($request->quantity as $cart_id=>$quantity) {
            Cart::find($cart_id)->update([
                'quantity'=>$quantity,
                
            ]);
        }
        return back();
    }

}

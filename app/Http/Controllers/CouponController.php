<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // coupon view
    public function coupon()
    {
        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('admin.coupon.index', [
            'coupons'=>$coupons,
        ]);
    }
    // coupon insert
    public function coupon_insert(Request $request)
    {
        Coupon::insert([
            'coupon_code'=>$request->coupon_code,
            'discount'=>$request->discount,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }
    // coupon delete
    public function delete($id)
    {
       Coupon::find($id)->delete();
       return back()->with('coupon_delete', 'coupon deleted successfully!'); 
    }
}

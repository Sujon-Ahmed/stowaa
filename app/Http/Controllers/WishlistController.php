<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id', Auth::guard('customer')->id())->get();
        return view('frontend.wishlist',[
            'wishlist'=>$wishlist,
        ]);
    }

    public function add_wishlist(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = Auth::guard('customer')->id();

        $wishlist = new Wishlist();
        $wishlist->user_id = $user_id;
        $wishlist->product_id = $product_id;
        $wishlist->save();
        return back()->with('add_wishlist', 'Product added to Wishlist');
    }

    public function remove_wishlist(Request $request)
    {
        // return $request->product_id;
        Wishlist::find($request->product_id)->delete();
        return back();
    }

}

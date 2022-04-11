<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_users_number = User::count();
        $total_categories = Category::count();
        $total_products = Product::count();
        $total_orders = Order::count();
        return view('home', [
            'total_users_number' => $total_users_number,
            'total_categories' => $total_categories,
            'total_products' => $total_products,
            'total_orders' => $total_orders,
        ]);
        // return view('layouts.master');
    }

    public function user_delete($id)
    {
        // return $id;
        User::find($id)->delete();
        return back()->with('delete', 'User Delete Success');
    }

    // users
    public function users()
    {
        $logged_user_id = Auth::id();
        $logged_user_name = Auth::user()->name;
        $total_users_number = User::count();
        $total_users = User::where('id', '!=', $logged_user_id)->orderBy('id','desc')->simplePaginate(5);
        return view('admin.users.index', compact('logged_user_name', 'total_users_number', 'total_users'));
    }

    public function orderDetails()
    {
        $orders = Order::all();
        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function orderDelete($id)
    {
        Order::find($id)->delete();
        BillingDetail::find($id)->delete();
        $order_products = OrderedProduct::where('order_id', $id)->get();
        foreach ($order_products as $product) {
            OrderedProduct::find($product)->delete();
        }
        return back();
    }

    public function admin_profile()
    {
        return view('admin.profile.index');
    }
}

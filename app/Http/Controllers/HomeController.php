<?php

namespace App\Http\Controllers;

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
        return view('home');
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
}

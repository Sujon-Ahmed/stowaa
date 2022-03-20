<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CustomerAuthenticationController extends Controller
{
    public function customer_authentication()
    {
        return view('/frontend/customer_authentication');
    }

    public function customer_login_authentication(Request $request) 
    {
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }  else {
            return redirect('/customer/authentication');
        }
    }

    public function customer_register_authentication(Request $request)
    {
        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    public function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/customer/authentication');
    }
}

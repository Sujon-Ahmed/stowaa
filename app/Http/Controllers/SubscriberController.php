<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        Subscriber::insert([
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('status', 'Thanks for Subscribe!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function contact_message_insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        Contact::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('status','Your Message Submit Successfully');
    }

    public function contact_messages()
    {
        $messages = Contact::all();
        return view('admin.contact_messages.index', [
            'messages'=>$messages,
        ]);
    }

    public function contact_message_delete($id)
    {
        Contact::find($id)->delete();
        return back()->with('status', 'Message Deleted Successfully');
    }
}

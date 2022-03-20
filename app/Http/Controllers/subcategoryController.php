<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class subcategoryController extends Controller
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
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.subcategory.index', compact('categories','subcategories'));
    }
    public function add_subcategory()
    {
        $categories = Category::all();
        return view('admin.subcategory.add', compact('categories'));
    }
    // insert 
    public function insert(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required',
        ]);

        if(Subcategory::where('category_id',$request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('exist', 'Subcategory Already Exist in Selected Category!');
        } else {
            Subcategory::insert([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success', 'Subcategory Added Successfully');
        }        
    }
    // delete
    public function delete($id)
    {
        Subcategory::find($id)->delete();
        return back()->with('delete', 'Subcategory Delete Success');
    }
    // edit
    public function edit($id)
    {
        $categories = Category::all();
        $subcategories = Subcategory::find($id);
        return view('admin.subcategory.edit', [
            'categories'=>$categories, 
            'subcategories'=>$subcategories,
        ]);
    }
    // update
    public function update(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'subcategory_name'=>'required',
        ]);

        if(Subcategory::where('category_id',$request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('exist', 'Subcategory Already Exist in Selected Category!');
        } else {
            Subcategory::find($request->subcategory_id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'created_at'=>Carbon::now(),
            ]);
            return redirect('/subcategory/index')->with('success_update', 'Subcategory Updated Successfully');
        }   
    }
}

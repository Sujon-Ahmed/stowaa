<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\CategoryRequest;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
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
    
    public function category()
    {
        $categories = Category::all();
        $total_categories = Category::count();
        return view('admin.category.index', compact('categories','total_categories'));
    }
    public function category_add() 
    {
        return view('admin.category.add');
    }
    public function category_trashed()
    {
        $trashed_categories = Category::onlyTrashed()->get();
        return view('admin.category.trashed',compact('trashed_categories'));
    }
    // category insert
    public function category_insert(CategoryRequest $request)
    {
        $category_id = Category::insertGetId([
            'category_name'=>$request->category_name,
            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);
        $category_image = $request->category_image;
        $extension = $request->category_image->getClientOriginalExtension();
        $file_name = $category_id.'.'.$extension;
        
        Image::make($category_image)->resize(256, 200)->save(public_path('/uploads/categories/'.$file_name));

        Category::find($category_id)->update([
            'category_image'=>$file_name,
        ]);

        return back()->with('success', 'Category Insert Success');
    }
    // category soft delete
    public function category_soft_delete($id)
    {
        Category::find($id)->delete();
        return back()->with('soft_delete', 'Category Soft Delete Success');
    }
    // category restore
    public function category_restore($id)
    {
            Category::onlyTrashed()->find($id)->restore();
            return back();
    }
    // category hard delete
    public function category_hard_delete($id)
    {
        $category_info = Category::onlyTrashed()->find($id);
        $image = $category_info->category_image;
        $delete_from = public_path('/uploads/categories/'.$image);
        unlink($delete_from);
        Category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('permanent_delete', 'Category Permanently Delete Success');
    }   
    // Category edit
    public function category_edit($id)
    {
        $category_info = Category::find($id);
        return view('admin.category.edit', compact('category_info'));
    }
    // category update
    public function category_update(CategoryRequest $request)
    {

        if ($request->category_image != '') {

            $category_info = Category::find($request->id);
            
            if ($category_info->category_image != '') {
                unlink(public_path('uploads/categories/'.$category_info->category_image));
            }
            
            $image_name = $request->id.'.'.$request->category_image->getClientOriginalExtension();
            
            Image::make($request->category_image)->fit(680, 680)->save(public_path('uploads/categories/'.$image_name));

            
            Category::find($request->id)->update([
                'category_image'=>$image_name,
            ]);
        }
        
        Category::find($request->id)->update([
            'category_name'=>$request->category_name,
        ]);
        return redirect('category')->with('category_update', 'Category Update Successfully');
    }
    // category mark all delete
    public function category_mark_delete(Request $request)
    {
        if ($request->mark1 == '') {
            return back()->with('empty', 'Please, checked At least one category!');
        } else {
            foreach($request->mark1 as $marked) {
                Category::find($marked)->delete();
            }
            return back();
        }
    }
    // trashed category restore delete
    public function category_mark_restore_delete(Request $request)
    {
        if ($request->mark2 == '') {
            return back()->with('empty2', 'Please, checked At least  one category!');
        } else {
            if ($request->btn == 1) {
                foreach($request->mark2 as $marked) {
                    Category::onlyTrashed()->find($marked)->restore();
                }
                return back();
            } else {
                foreach($request->mark2 as $marked) {
                    $category_info = Category::onlyTrashed()->find($marked);
                    $image = $category_info->category_image;
                    $delete_from = public_path('/uploads/categories/'.$image);
                    unlink($delete_from);

                    Category::onlyTrashed()->find($marked)->forceDelete();
                }
                return back();
            }
        }
    }



}

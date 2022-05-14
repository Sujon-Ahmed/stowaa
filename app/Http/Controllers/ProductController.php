<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $all_categories = Category::all();
        $all_subcategories = Subcategory::all();
        return view('admin/products/index',
        [
            'all_categories'=>$all_categories,
            'all_subcategories'=>$all_subcategories,
        ]);
        
    }

    public function view_products()
    {
        $all_products = Product::all();
        return view('admin/products/view', 
        [
            'all_products'=>$all_products,
        ]);
        // return response()->json(['all_products' => $all_products], 200);
    }

    public function edit_products($id)
    {
        $all_categories = Category::all();
        $all_subcategories = Subcategory::all();
        $product_info = Product::find($id);
        return view('admin.products.edit', [
            'all_categories'=>$all_categories,
            'all_subcategories'=>$all_subcategories,
            'product_info'=>$product_info,
        ]);
    }

    public function product_update(Request $request)
    {
        Product::find($request->id)->update([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_discount'=>$request->product_discount,
            'after_discount'=>$request->product_price - $request->product_price * $request->product_discount / 100,
            'quantity'=>$request->quantity,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
        ]);
        return redirect()->route('view.product')->with('product_update', 'Product Updated Successfully');
    }

    public function getCategory(Request $request)
    {
        $str_to_send = '<option value="" class="form-control">-- Select Category --</option>';
        foreach(Subcategory::where('category_id', $request->category_id)->get() as $subcategory) {
            $str_to_send .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str_to_send;
    }

    public function product_insert(Request $request)
    {
        $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_discount'=>$request->product_discount,
            'after_discount'=>$request->product_price - $request->product_price * $request->product_discount / 100,
            'quantity'=>$request->quantity,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'created_at'=>Carbon::now(),
        ]);
        $preview_image = $request->product_preview;
        $preview_image_extension = $preview_image->getCLientOriginalExtension();
        $preview_name = $product_id.'.'.$preview_image_extension;
        Image::make($preview_image)->resize(680,680)->save(public_path('/uploads/products/preview/'.$preview_name));
        Product::find($product_id)->update([
            'product_preview'=>$preview_name,
        ]);
 
        $loop = 1;
        
        foreach($request->product_thumbnail as $thumbnail) {
            $thumbnail_extension =  $thumbnail->getClientOriginalExtension();
            $thumbnail_name = $product_id.'-'.$loop.'.'.$thumbnail_extension;
            Image::make($thumbnail)->resize(680, 680)->save(public_path('/uploads/products/thumbnails/'.$thumbnail_name));
            ProductThumbnail::insert([
                'product_id'=>$product_id,
                'thumbnail'=>$thumbnail_name,
                'created_at'=>Carbon::now(),
            ]);
            $loop ++;
        }
        return back();

    }

    public function product_delete($id) 
    {
        $product_image = Product::where('id', $id)->first()->product_preview;
        $delete_form = public_path('/uploads/products/preview/'.$product_image);
        unlink($delete_form);

        $product_thumbnail = ProductThumbnail::where('product_id', $id)->get();
        foreach($product_thumbnail as $thumbnail) {
            $delete_form = public_path('/uploads/products/thumbnails/'.$thumbnail->thumbnail);
            unlink($delete_form);
        }

        Product::find($id)->delete();
        return back();
    }
}

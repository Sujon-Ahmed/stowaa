<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', [
            'brands' => $brands
        ]);
    }
    public function store(Request $request)
    {
        $brand = new Brand();
        $brand_image = $request->photo;
        $brand_image_extension = $brand_image->getClientOriginalExtension();        
        $image_name = uniqid().'.'.$brand_image_extension;
        Image::make($brand_image)->resize(380,80)->save(public_path('/uploads/brands/'.$image_name));
        $brand->brand_img = $image_name;
        $brand->save();
        return back()->with('status', 'Brand has been inserted successfully!');
    }
    // change status
    public function status_change(Request $request)
    {
        $status = Brand::find($request->id);
        $status->status = $request->status;
        $status->save();
    }
}

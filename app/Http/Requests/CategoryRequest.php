<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name'=>'required | unique:categories',
            // 'category_image'=>'required',
            // 'category_image'=>'mimes:jpg,bmp,jpeg,png',
            // 'category_image'=>'file|max:5084',
        ];
    }

    public function messages()
    {
        return [
            'category_name.required'=>'Enter Category Name',
            'category_name.unique'=>'This Category Already Exist!',
        ];
    }
}

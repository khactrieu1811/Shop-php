<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' =>  'bail|required|unique:products|max:255|min:10',
            'price' => 'required',
            'category_id' => 'required',
            'contents' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'tên không được phép bỏ trống',
            'name.unique'  => 'tên không được phép trùng',
            'name.max'  => 'tên không được phép quá 255 ký tự',
            'name.min'  => 'tên không được phép dưới 10 ký tự',
            'price.required'  => 'không được phép bỏ trống',
            'category_id.required'  => 'không được phép bỏ trống',
            'contents.required'  => 'không được phép bỏ trống',
        ];
    }
}

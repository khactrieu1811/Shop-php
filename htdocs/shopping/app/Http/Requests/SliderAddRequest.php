<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'required|unique:sliders|max:255',
            'description' => 'required',
            'image_path' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'tên không được phép bỏ trống',
            'name.unique'  => 'tên không được phép trùng',
            'name.max'  => 'tên không được phép quá 255 ký tự',
            'description.required'  => 'không được phép bỏ trống',
            'image_path.required'  => 'không được phép bỏ trống',
        ];
    }
}

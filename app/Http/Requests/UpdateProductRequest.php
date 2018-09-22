<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'    => 'required|min:3',
            'description'   => 'required',
            'vendor'=> 'required',
        ];
    }
    public function messages(){
        return[
            'name.required' => ' tên không được bỏ trống',
            'name.min' => 'tối thiểu phải  3 kí tự trở lên',
            'description.required' => 'mô tả không được phép bỏ trống',
            'vendor.required' => 'nhà cung cấp không được phép bỏ trống',

        ];
    }
}

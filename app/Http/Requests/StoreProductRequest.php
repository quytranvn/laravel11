<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price'   => 'required|numeric',
            'description'=> 'required',
        ];
    }
    public function messages(){
        return[
            'name.required'=>'Bạn chưa nhập name',
            'name.min'=>'Tên phải có ít nhất 3 kí tự',
            'price.required'=>'bạn chưa nhập giá',
            'price.numeric' => 'bạn phải nhập chữ số',
            'description.required'=>'Mô tả không được phép để trống',

        ];
    }
}

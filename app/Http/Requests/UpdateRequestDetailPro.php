<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestDetailPro extends FormRequest
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
    
            'quantity'    => 'required|min:1',
            'code'   => 'required',
            
        ];
    }
    public function messages(){
        return[
            'quantity.required'=>'Bạn chưa nhập số lượng    ',
            'quantity.min'=>'số lượng phải lớn hơn hoặc bằng 1',
            'code.required'=>'bạn chưa nhập mã sản phẩm',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestUser extends FormRequest
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
            'email'   => 'required|email',
            'password'   => 'required|min:8',
            
        ];
    }
    public function messages(){
        return[
            'name.required'=>'Tên không được bỏ trống',
            'name.min'=>'tên phải tối thiểu từ 3 kí tự',
            'email.required'=>'Email không được bỏ trống',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'password không được bỏ trống',
            'password.min'=>'password phải từ 8 kí tự trở lên',

        ];
    }
}

<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => ':attribute không được để trống',
            'password.required' => ':attribute không được để trống'
        ];
    }
    public function attributes(){
        return [
            'name' => 'Tên đăng nhập',
            'password' => 'Mật khẩu'
        ];
    }
}

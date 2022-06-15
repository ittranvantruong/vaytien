<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->method() == 'PUT'){
            if($this->routeIs('update.change.password')){
                return [
                    'password' =>['required'],
                    'new_password' => ['required', 'max:255', 'confirmed'],
                    'new_password_confirmation' => ['required']
                ];
            }else{
                return [];
            }
        }elseif($this->method() == 'POST'){
            if($this->routeIs('post.register')){
            return [
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone'],
                'password' => 'required',
            ];
            }else{
                return [];
            }
        }else{
                return [];
        }
    }
    public function attributes(){
        return [
            'phone' => 'Số điện thoại',
            'password' => 'Mật khẩu',
        ];
    }
    public function messages(){
        return [
            'password.required' => 'Mật khẩu không được bỏ trống',
            'new_password.required' => 'Mật khẩu mới không được bỏ trống',
            'new_password.max' => 'Mật khẩu mới quá dài',
            'new_password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'new_password_confirmation.unique' => 'Nhập lại mật khẩu không được bỏ trống',
            'phone.regex' => ':attribute không hợp lệ',
            'phone.unique' => ':attribute đã có người sử dụng',
        ];
    }
}

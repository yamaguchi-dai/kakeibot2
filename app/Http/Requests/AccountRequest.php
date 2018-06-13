<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest {

   
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true; // ひとまずこれをtrueにすると使える
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        // ここにValidationルールを記載
        return [
            'login_id' => 'required|unique:m_user,user_id',
            'password' => 'required|same:check_password|password',
            'check_password'=>'required'
        ];
    }

//    public function messages() {
//        return [
//            'test.required' => 'ほげ入力は必須項目です。',
//        ];
//    }

}

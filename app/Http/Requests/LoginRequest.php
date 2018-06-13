<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

   
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
            'user_id' => 'required',
            'password' => 'required',
        ];
    }

    public function messages() {
        return [
            'user_id.test' => 'tasuke-te-。',
        ];
    }

}

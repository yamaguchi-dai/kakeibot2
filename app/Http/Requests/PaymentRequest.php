<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class PaymentRequest extends FormRequest {

   
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
        $mode = $this->input('mode');
        //更新の時はバリデーションは行わない
        if($mode == 'update'){
            return [];
        }
        // ここにValidationルールを記載
        return [
            'category_id' => 'required',
            'price' => 'required',
            'comment'=>'max:256'
        ];
    }

    public function messages() {
        return [
            'test.required' => 'ほげ入力は必須項目です。',
        ];
    }

}

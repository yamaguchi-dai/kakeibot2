<?php

namespace App\Validator;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator {

    /**
     * パスワードバリデーション　英数組み合わせ8文字以上
     * @param type $attribute
     * @param type $value
     * @param type $parameters
     * @return boolean
     */
    public function validatepassword($attribute, $value, $parameters) {
        $is_validate = false;
        if (preg_match("/[A-Za-z]/", $value) && preg_match("/[0-9]/", $value) && mb_strlen($value) >= 8) {
            $is_validate = true;
        }
        return $is_validate;
    }

}

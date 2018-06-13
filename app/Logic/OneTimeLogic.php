<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Logic;

use App\Logic\AppLogic;
use App\Model\User;
use App\Model\OnetimePassword;

define("ONETIME_LENGTH", 26); //ワンタイムパスワードの長さ
define("USED_FLAG", "0"); //使用済み
define("USE_FLAG", "1"); //未使用
/**
 * Description of OneTimeLogic
 *
 * @author user
 */


/**
 * 未登録であることを確認
 */
class OneTimeLogic extends AppLogic {

    /**
     * 未登録のユーザーであることを確認
     * @param type $line_id
     * @return boolean
     */
    function already_create_accont($line_id) {
        $model = User::where('line_id', $line_id)
                ->whereNotNull('user_id')
                ->first();
        if (!$model) {
            return true;
        } else {
            return false;
        }
    }

    function auth_onetime($onetime) {
        $isAuth = true;
        $msg    = '';
        $model  = OnetimePassword::where("onetime_password", $onetime)->first();

        if (!$model) {
            $msg    = '存在しないパスワードです';
            $isAuth = false;
        } else if ($model->use_flag == USED_FLAG) {
            $msg    = '使用済みパスワードです';
            $isAuth = false;
        }
        return [$isAuth, $msg, $model];
    }

    function regist_onetime_password($line_id) {
        $model = new OnetimePassword;
        $model->id = $this->create_onetime_seq();
        $model->onetime_password = $this->make_onetime_password();
        $model->line_id = $line_id;
        $model->use_flag = USE_FLAG;

        $model->save();

        return $model->onetime_password;
    }

    /**
     * ワンタイムパスワード作成
     * @return type
     */
    private function make_onetime_password() {
        //ワンタイムパスワード生成
        $onePass = strtr(substr(base64_encode(openssl_random_pseudo_bytes(ONETIME_LENGTH * 2)), 0, ONETIME_LENGTH * 2), '/+', '_-');
        //記号をnullに全置換する
        $timePass = preg_replace("/[^0-9a-zA-Z]/", "", $onePass);
        //(1-26)文字で切り出し
        $oneTimePass = substr($timePass, 0, ONETIME_LENGTH);

        return $oneTimePass;
    }

}

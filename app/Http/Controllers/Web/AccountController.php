<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppController;
use App\Http\Requests\AccountRequest;
use App\Model\User;
use App\Model\Password;
use App\Model\OnetimePassword;

define("USED_FLAG", "0"); //使用済み

class AccountController extends AppController {


    public function index($line_id) {
        return view('Account/create', ['line_id' => $line_id]);
    }

    public function create(AccountRequest $request) {
        $login_id      = $request->input('login_id');
        $password      = $request->input('password');
        $line_id       = $request->input('line_id');
        $user          = User::where('line_id', $line_id)->first();
        $user->user_id = $login_id;
        $user->save();

        /**
         * ワンタイムを使用済みに変更
         */
        OnetimePassword::where('line_id', $line_id)->update(['use_flag' => USED_FLAG]);

        $passModel = new Password;
        $passModel->user_id = $login_id;
        $passModel->password = $password;
        $passModel->save();
        
        /** 登録したユーザーでログイン処理*/
        $this->auth_login(User::where("user_id", $login_id)->first());
        
        return view('Account/complete', ['login_id' => $login_id]);
    }

}

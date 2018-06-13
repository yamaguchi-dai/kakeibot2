<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppController;
use App\Http\Requests\LoginRequest;
use App\Model\User;

class LoginController extends AppController {

   // public $logic;

    public function index() {
        return view("Login/login");
    }

    public function login(LoginRequest $request) {  

        $input_user_id = $request->input("user_id");
        $input_password = $request->input('password');

        $model = User::where("user_id", $input_user_id)->first();

        if (!$model) {
            return back()->withInput()
                            ->withErrors([
                                'tmp' => 'ユーザーIDを正しく入力してください',
            ]);
        } elseif ($model->password->password != $input_password) {
            return back()->withInput()
                            ->withErrors([
                                'tmp' => 'パスワードを正しく入力してください',
            ]);
        }
        
        $this->auth_login($model);
        
        return redirect('home');
    }
    
    public function logout(){
        session()->flush();
        return redirect('/');
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use App\Logic\OneTimeLogic;
use App\Logic\Payment\PaymentLogic;
use App\Model\Budget;
use App\Model\User;
use App\Model\Payment;
use App\Model\UserPayCategory;

class LineController extends AppController {

    public $payment_logic;

    function __construct() {
        $this->payment_logic = new PaymentLogic();
    }

    /**
     * GoogleAppsScriptからの入り口。
     * @param Request $request
     * @return string リプライ用メッセージ
     */
    function main(Request $request) {
        $line_id = $request->input("line_id");
        $text = $request->input("text");

        //ユーザー登録初期セットアップ
        $this->follow($request);
        switch (TRUE) {
            /*             * ****************************************************************************************************
             * ワンタイムURL生成処理
             * **************************************************************************************************** */
            case preg_match('/新規登録/', $text):
                $onetimeLogic = new OneTimeLogic();
                if ($onetimeLogic->already_create_accont($line_id)) {


                    $onetime = $onetimeLogic->regist_onetime_password($line_id);

                    return 'http://' . env('APP_IP', '153.126.188.186') . '/onetime/auth/' . $onetime;
                } else {
                    return '登録済みのユーザー';
                }
                break;
            /*             * ****************************************************************************************************
             * 合計金額表示
             * **************************************************************************************************** */
            case preg_match('/今月/', $text) || preg_match('/先月/', $text) || preg_match('/先々月/', $text):
                $target_month = $this->payment_logic->get_month($text);
                $category_list = $this->payment_logic->get_category($line_id);
                $msg = '';
                foreach ($category_list as $category) {
                    $msg .= $category->name . '::' . $this->payment_logic->get_category_payment($line_id, $category->id, $target_month) . "\n";
                }

                return $msg;
                break;
            /*             * ****************************************************************************************************
             * 金額登録処理
             * **************************************************************************************************** */
            case ctype_digit($text):
                $pay_none = Payment::where('line_id', $line_id)
                        ->whereNull('price')
                        ->first();
                if (!$pay_none) {
                    return 'カテゴリを登録してください';
                }
                $pay_none->price = $text;
                $pay_none->save();
                return '金額を登録をしやした。';
                break;
            /*             * ****************************************************************************************************
             * 　ヘルプ表示処理
             * **************************************************************************************************** */
            case preg_match('/ヘルプ/', $text):
                $msg = '';
                $categori_list = UserPayCategory::where('line_id', $line_id)->get();
                foreach ($categori_list as $category) {
                    $msg .= $category->name . "\n";
                }

                return $msg;

                break;
            /*             * ****************************************************************************************************
             * 支払先カテゴリ登録処理
             * **************************************************************************************************** */
            default :
                $model = $this->payment_logic->search_category($line_id, $text);
                if (!$model) {
                    return '存在しないカテゴリです';
                }

                $this->payment_logic->insert_payment($this->create_payment_seq(), $line_id, $model->id, null,null);
                return 'カテゴリ登録しやした。';
        }
    }

    /**
     * フォローイベント
     * @param type $request
     * @return string
     */
    function follow($request) {
        $line_id = $request->input("line_id");

        $u_model = User::where('line_id', $line_id)->first();
        if (!$u_model) {
            $user = new User;
            $user->id = $this->create_user_seq();
            $user->line_id = $line_id;
            $user->save();
            $category_list = ['食費','趣味','交際費','光熱費'];
            foreach ($category_list as $category) {
                $payCategory = new UserPayCategory;
                $payCategory->id = $this->create_user_pay_category_seq();
                $payCategory->line_id = $line_id;
                $payCategory->name = $category;
                $payCategory->save();

                $budget = new Budget;
                $budget->id = $this->create_budget_seq();
                $budget->line_id = $line_id;
                $budget->category_id = $payCategory->id;
                $budget->price = 0;
                $budget->save();
            }
        }
        return 'OK';
    }

}

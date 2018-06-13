<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/04/22
 * Time: 13:02
 */

namespace App\Http\Controllers\Api\LineInterface;

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use App\Logic\OneTimeLogic;
use App\Logic\Payment\PaymentLogic;
use App\Model\Budget;
use App\Model\User;
use App\Model\Payment;
use App\Model\UserPayCategory;
use App\Logic\AppLogic;

class Logic extends AppLogic {

    /**
     * 返信メッセージ作成処理
     *
     * @param $text
     * @param $line_id
     * @return string
     */
    function make_return_msg($text, $line_id) {
        switch (TRUE) {
            /*             * ****************************************************************************************************
             * ワンタイムURL生成処理
             * **************************************************************************************************** */
            case preg_match('/新規登録/', $text):
                $onetimeLogic = new OneTimeLogic();
                if ($onetimeLogic->already_create_accont($line_id)) {


                    $onetime = $onetimeLogic->regist_onetime_password($line_id);
                    return 'https://' . env('APP_DOMAIN') . '/onetime/auth/' . $onetime;
                } else {
                    return '登録済みのユーザー';
                }
                break;
            /*             * ****************************************************************************************************
             * 合計金額表示
             * **************************************************************************************************** */
            case preg_match('/今月/', $text) || preg_match('/先月/', $text) || preg_match('/先々月/', $text):
                $payment_logic = new PaymentLogic();
                $target_month  = $payment_logic->get_month($text);
                $category_list = $payment_logic->get_category($line_id);
                $msg           = '';
                foreach ($category_list as $category) {
                    $msg .= $category->name . '::' . $payment_logic->get_category_payment($line_id, $category->id, $target_month) . "\n";
                }
                return $msg;
                break;
            /*             * ****************************************************************************************************
             * 金額登録処理
             * **************************************************************************************************** */
            case ctype_digit($text):
                $pay_none = Payment::where('line_id', $line_id)->whereNull('price')->first();
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
                $msg           = '';
                $categori_list = UserPayCategory::where('line_id', $line_id)->get();
                foreach ($categori_list as $category) {
                    $msg .= $category->name . "\n";
                }
                return $msg;
                break;

            /*             * ****************************************************************************************************
             * 　ログインページURL取得
             * **************************************************************************************************** */
            case preg_match('/ログイン/', $text):
                return 'https://' . env('APP_DOMAIN') . '/login';
                break;
            /*             * ****************************************************************************************************
             * 支払先カテゴリ登録処理
             * **************************************************************************************************** */
            default :
                $payment_logic = new PaymentLogic();
                $model         = $payment_logic->search_category($line_id, $text);
                if (!$model) {
                    return '存在しないカテゴリです';
                }
                $payment_logic->insert_payment($this->create_payment_seq(), $line_id, $model->id, null, null);
                return 'カテゴリ登録しやした。';
        }
    }

    /**
     * LineMessagingApi実行
     *
     * @param $input_msg
     * @param $reply_token
     */
    function exec_messaging_reply_api($input_msg, $reply_token) {


        //テキストをオウム返し
        $messageData = [
            'type' => 'text',
            'text' => $input_msg
        ];
        $response    = [
            'replyToken' => $reply_token,
            'messages' => [$messageData]
        ];
        $ch          = curl_init(env('MESSAGING_API_REPLY_URL'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . env('LINE_ACCESS_TOKEN')));
        $result = curl_exec($ch);
        $this->log($result);
        curl_close($ch);

    }

    /**
     * ユーザー登録処理 予算自動登録
     * 登録済みの場合、何もしない
     *
     * @param $line_id
     * @return string
     */
    function follow($line_id) {

        $u_model = User::where('line_id', $line_id)->first();
        if (!$u_model) {
            $user          = new User;
            $user->id      = $this->create_user_seq();
            $user->line_id = $line_id;
            $user->save();
            $category_list = ['食費', '趣味', '交際費', '光熱費'];
            foreach ($category_list as $category) {
                $payCategory          = new UserPayCategory;
                $payCategory->id      = $this->create_user_pay_category_seq();
                $payCategory->line_id = $line_id;
                $payCategory->name    = $category;
                $payCategory->save();
                $budget              = new Budget;
                $budget->id          = $this->create_budget_seq();
                $budget->line_id     = $line_id;
                $budget->category_id = $payCategory->id;
                $budget->price       = 0;
                $budget->save();
            }
        }
    }

}
<?php

namespace App\Logic\Payment;

use App\Logic\AppLogic;
use App\Model\Payment;
use App\Model\UserPayCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Description of PaymentLogic
 *
 * @author dai
 */
class PaymentLogic extends AppLogic {
    
    /**
     * カテゴリ名称検索
     * @param type $line_id
     * @param string $text
     * @return type
     */
    function search_category($line_id,$text){
        $text = '%'.$text.'%';
        $model = UserPayCategory::
                where('name','like',$text)
                ->where('line_id',$line_id)
                ->first();
        
        return $model;
    }
    
    /**
     * ユーザーのカテゴリ取得
     * @param type $line_id
     * @return type
     */
    function get_category($line_id){
        $model_list = UserPayCategory::
                where('line_id',$line_id)
                ->get();
        
        return $model_list;
    }

    /**
     * 入力されたメッセージから先月/
     * @param type $text
     * @return int
     */
    function get_month($text) {
        $tmp = '+0'; //0=今月
        switch (TRUE) {
            CASE preg_match('/先月/', $text):
                $tmp = '-1';
                break;
            CASE preg_match('/先々月/', $text):
                $tmp = '-2';
                break;
        }

        $month = date('m', strtotime(date('Y-m-1') . $tmp . ' month'));
        return $month;
    }
 
    /**
     * 指定月カテゴリごとの合計金額取得
     * @param type $user_id ユーザーＩＤ
     * @param type $category_id カテゴリ
     * @param type $month
     * @return type
     */
    function get_category_payment($line_id, $category_id, $month) {
        //SELECT to_char(substring(yyyymmddhhmiss from 1 for 8)::date,'yyyymm') as ym FROM tmp;
        $res = Payment::where("line_id", $line_id)
                ->where("category_id", $category_id)
                ->where(DB::raw("to_char(substring(created_at from 1 for 8)::date,'mm')"), $month)
                ->get()
                ->sum('price');

        return $res;
    }

    /**
     * 支払い情報取得処理　一覧表示用
     * @param type $line_id
     * @return type
     */
    function get_payment($line_id,$month) {
        $res = Payment::where("line_id", $line_id)
                ->select(DB::raw('id::Integer as tmp, *'))
                ->where(DB::raw("to_char(substring(created_at from 1 for 8)::date,'mm')"), $month)
                ->orderBy('tmp')
                ->get();
        Log::debug($res->toArray());
        return $res;
    }

    /**
     * 支払い登録
     * @param type $user_id
     * @param type $category_id
     * @param type $price
     */
    function insert_payment($seq, $line_id, $category_id, $price,$comment) {
        $payment = new Payment;
        $payment->id = $seq;
        $payment->line_id = $line_id;
        $payment->category_id = $category_id;
        $payment->comment = $comment;
        $payment->price = $price;
        $payment->save();
    }

    function update_payment($seq, $price,$comment='') {
        $payment = Payment::find($seq);
        $payment->price = $price;
        $payment->comment = $comment;
        $payment->save();
    }

}

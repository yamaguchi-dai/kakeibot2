<?php

namespace App\Logic;

use App\Logic\AppLogic;
use App\Model\Payment;
use App\Model\Budget;
use Illuminate\Support\Facades\DB;

/**
 * Description of BudgetLogic
 *
 * @author dai
 */
class HomeLogic extends AppLogic {

    /**
     * 今月登録された合計金額を取得
     * @param type $user_id
     * @return type
     */
    function get_this_month_price($line_id) {
        $month = date('m', strtotime(date('Y-m-1') . '+0 month'));
        $res = Payment::where("line_id", $line_id)
                ->where(DB::raw("to_char(substring(created_at from 1 for 8)::date,'mm')"), $month)
                ->get()
                ->sum('price');
        return $res;
    }

    /**
     * 先月登録された合計金額を取得
     * @param type $user_id
     * @return type
     */
    function get_last_month_price($line_id) {
        $month = date('m', strtotime(date('Y-m-1') . '-1 month'));
        $res = Payment::where("line_id", $line_id)
                ->where(DB::raw("to_char(substring(created_at from 1 for 8)::date,'mm')"), $month)
                ->get()
                ->sum('price');
        return $res;
    }

    function get_budget_sum_price($line_id) {
        $res = Budget::where("line_id", $line_id)
                ->get()
                ->sum('price');
        return $res;
    }

}

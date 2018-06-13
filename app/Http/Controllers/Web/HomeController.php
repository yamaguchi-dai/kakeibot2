<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppController;
use App\Logic\HomeLogic;
use Illuminate\Support\Facades\Log;
class HomeController extends AppController {

    public function index() {
        $pay_logic = new HomeLogic();

        $user_id = $this->get_auth_user_id();
        Log::debug('今月合計取得');        
        $this_month_sum = $pay_logic->get_this_month_price($user_id);
        Log::debug('先月合計取得');
        $last_month_sum = $pay_logic->get_last_month_price($user_id);
        Log::debug('予算合計取得');
        $budget_sum = $pay_logic->get_budget_sum_price($user_id);

        //今月予算対比
        if ($this_month_sum != 0&&$budget_sum !=0) {
            $budget_percent = floor($this_month_sum / $budget_sum * 1000) / 10;
        } else {
            $budget_percent = 0;
        }
        //先月対比
        if ($last_month_sum != 0) {
            $last_month_percent = floor($this_month_sum / $last_month_sum * 1000) / 10;
        } else {
            $last_month_percent = 0;
        }

        return view("Home/home", [
            'this_month_sum' => $this_month_sum, //今月合計
            'last_month_sum' => $last_month_sum, //先月合計
            'budget_sum' => $budget_sum, //予算合計
            'budget_percent' => $budget_percent, //予算パーセント
            'last_month_percent' => $last_month_percent
        ]);
    }

}

<?php

namespace App\Logic;

use App\Logic\AppLogic;
use App\Model\Budget;
use App\Model\UserPayCategory;
use Illuminate\Support\Facades\DB;
/**
 * Description of BudgetLogic
 *
 * @author dai
 */
class BudgetLogic extends AppLogic {
 
    function get_budget_list($line_id){
        $res_list = Budget::where('line_id',$line_id)
                    ->select(DB::raw('id::Integer as tmp, *'))
                    ->orderBy('tmp')
                    ->get();
        
        return $res_list;
    }

    function get_total_budget_price($line_id){
        $this->log('合計金額取得');
        $sum_price = Budget::where('line_id',$line_id)
                    ->get()
                    ->sum('price');
        return $sum_price;
    }

    /**
     * カテゴリ登録
     * @param type $user_id
     * @param type $category_name
     */
    function regist_category($line_id,$category_name){
        $payCategory = new UserPayCategory;
        $payCategory->id = $this->create_user_pay_category_seq();
        $payCategory->line_id = $line_id;
        $payCategory->name = $category_name;
        $payCategory->save();
        
        return $payCategory->id;
    }
    
    /**
     * 予算登録
     * @param type $user_id
     * @param type $category_id
     * @param type $price
     * @return type
     */
    function regist_budget($line_id, $category_id, $price) {
        $budget = new Budget;
        $budget->id = $this->create_budget_seq();
        $budget->line_id = $line_id;
        $budget->category_id = $category_id;
        $budget->price = $price;
        $budget->save();

        return $budget->id;
    }

}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppController;
use App\Model\Budget;
use App\Model\UserPayCategory;
use App\Logic\BudgetLogic;
use App\Http\Requests\BudgetRequest;

class BudgetController extends AppController {

    public $logic;

    function __construct() {
        $this->logic = new BudgetLogic();
        parent::__construct();
    }

    public function index() {
        $user_id = $this->get_auth_user_id();
        $budget_list = $this->logic->get_budget_list($user_id);
        $sum_price = $this->logic->get_total_budget_price($user_id);
        return view("Budget/budget", [
            'budget_sum_price'=>    $sum_price,
            'budget_list' =>        $budget_list,
        ]);
    }

    /**
     * 登録処理
     * @param BudgetRequest $request
     * @return type
     */
    public function regist(BudgetRequest $request) {
        $name = $request->input('name');
        $price = $request->input('price');
        $user_id =$this->get_auth_user_id();

        //カテゴリ登録
        $category_id = $this->logic->regist_category($user_id, $name);
        //予算登録
        $this->logic->regist_budget($user_id, $category_id, $price);
        return redirect('budget');
    }
    
    /**
     * 更新処理
     * @param BudgetRequest $request
     * @return type
     */
    public function update(BudgetRequest $request){
        $name = $request->input('name');
        $price = $request->input('price');
        $seq = $request->input('seq');
        
        //予算テーブルの数値を更新
        $budget = Budget::find($seq);
        $budget->price = $price;
        $budget->save();
        
        //カテゴリテーブルの名称を更新
        $user_pay_category = UserPayCategory::find($budget->category_id);
        $user_pay_category->name = $name;
        $user_pay_category->save();
        
        return redirect('budget');
    }

}

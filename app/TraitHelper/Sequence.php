<?php

namespace App\TraitHelper;

use Illuminate\Support\Facades\DB;

/*
 * シーケンス発行ヘルパートレイと
 */

/**
 *
 * @author dai.yamaguchi
 */
trait Sequence {

    //put your code here
    function create_payment_seq() {
        return DB::selectOne("select nextval('payment_seq')")->nextval;
    }

    function create_budget_seq() {
        return DB::selectOne("select nextval('budget_seq')")->nextval;
    }

    function create_user_pay_category_seq() {
        return DB::selectOne("select nextval('user_pay_category_seq')")->nextval;
    }

    function create_onetime_seq() {
        return DB::selectOne("select nextval('onetime_seq')")->nextval;
    }
    
    function create_user_seq(){
        return DB::selectOne("select nextval('user_seq')")->nextval;
    }

}

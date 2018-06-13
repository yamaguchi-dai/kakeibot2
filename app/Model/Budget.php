<?php

namespace App\Model;

use App\Model\AppModel;
use Illuminate\Support\Facades\Log;

class Budget extends AppModel {

    //テーブル名
    protected $table = 't_budget';

    public function category() {
        Log::debug('testtesttest');
        Log::debug($this);
        return $this->belongsTo('App\Model\UserPayCategory');
    }

}

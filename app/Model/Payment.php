<?php

namespace App\Model;
use App\Model\AppModel;

class Payment extends AppModel {
    //テーブル名
    protected $table = 't_payment';
    public $incrementing = true;
    
    
    

    public function category(){
        return $this->belongsTo('App\Model\UserPayCategory');
    }
}

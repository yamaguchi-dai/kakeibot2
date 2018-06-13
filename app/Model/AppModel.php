<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AppModel extends Model {
    
    protected $dateFormat = 'YmdHis';
    //自動増分ではない、もしくは整数値でない
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    
    /**
     * SELECTの時はtimestamp使いたくないけど、
     * insert/updateの時は使いたいからオーバーライド
     * @param array $options
     */
    function save(array $options = array()) {
        $this->timestamps = true;
        parent::save($options);
        $this->timestamps = false;
    }

    
}

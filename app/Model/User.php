<?php

namespace App\Model;

use App\Model\AppModel;

class User extends AppModel {

    //テーブル名
    protected $table = 'm_user';

    function password() {
        return $this->hasOne('App\Model\Password','user_id','user_id');
    }

}

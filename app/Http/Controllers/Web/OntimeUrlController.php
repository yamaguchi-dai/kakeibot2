<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppController;
use App\Logic\OneTimeLogic;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class OntimeUrlController extends AppController {

    public $logic;

    function __construct() {
        $this->logic = new OneTimeLogic;
        parent::__construct();
    }

    public function auth($onetime) {
        list($isAuth, $msg, $model) = $this->logic->auth_onetime($onetime);

        if ($isAuth) {
            return redirect('AccountCreate/'.$model->line_id);
        } else {
            return $msg; //エラーメッセージ
        }
    }
    

}

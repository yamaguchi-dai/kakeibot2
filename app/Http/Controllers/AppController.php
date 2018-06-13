<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\TraitHelper\Sequence;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;


/**
 * Description of AppController
 *
 * @author dai
 */
class AppController extends Controller{
     use Sequence;
     public function __construct() {
    }

    /**
     * 
     */
    function auth_login($model) {
        // セッションへ一つのデータを保存する
        session(['auth' => true]);
        session(['auth_user' => [
                'user_id' => $model->id,
                'line_id'=> $model->line_id
        ]]);
    }
    
    function get_auth_user_id(){
        return session('auth_user.line_id');
    }

    function log($str){
        Log::debug(print_r($str,true));
    }

}

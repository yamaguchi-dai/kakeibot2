<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/04/21
 * Time: 1:04
 */
namespace App\Http\Controllers\Api\LineInterface;

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\LineInterface\Logic;

class index extends AppController {

    /**
     * MessagingApiからの入り口
     * @param Request $r
     */
    function request(Request $r){
        $this->log($r->input('events'));

        $line_info_array = $r->input('events')[0];
        $reply_token = $line_info_array['replyToken'];
        $input_msg = $line_info_array['message']['text'];
        $line_id = $line_info_array['source']['userId'];


        $logic = new Logic();

        $logic->follow($line_id);
        $return_msg = $logic->make_return_msg($input_msg,$line_id);
        $logic->exec_messaging_reply_api($return_msg,$reply_token);
    }




}

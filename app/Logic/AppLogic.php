<?php
namespace App\Logic;

use App\TraitHelper\Sequence;

use Illuminate\Support\Facades\Log;

/**
 * Description of AppLogic
 *
 * @author dai
 */
class AppLogic {
    //put your code here
    use Sequence;

    function log($str){
        Log::debug(print_r($str,true));
    }
}

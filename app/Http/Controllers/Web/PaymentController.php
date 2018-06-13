<?php

namespace App\Http\Controllers\Web;

use App\Logic\Payment\PaymentLogic;
use App\Http\Controllers\AppController;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Log;

class PaymentController extends AppController {

    /** */
    public $logic;

    function __construct() {
        $this->logic = new PaymentLogic();
        parent::__construct();
    }
    
    /**
     * 
     * @return type
     */
    public function index() {
        $line_id = $this->get_auth_user_id();
        $res = $this->logic->get_payment($line_id, $this->logic->get_month(""));
        $category_list = $this->logic->get_category($line_id);
        return view('Payment/payment', ['res' => $res, 'category_list' => $category_list]);
    }

    /**
     * 
     * @param PaymentRequest $request
     * @return type
     */
    public function regist(PaymentRequest $request) {
        $mode = $request->input('mode');
        $user_id = $this->get_auth_user_id();
        $category_id = $request->input("category_id");
        $price = $request->input("price");
        $comment = $request->input("comment");


        if ($mode == 'update') {
            $seq = $request->input("seq");
            $this->logic->update_payment($seq, $price,$comment);
        } else {

            $this->logic->insert_payment($this->create_payment_seq(), $user_id, $category_id, $price,$comment);
        }
        return redirect('payment');
    }

}

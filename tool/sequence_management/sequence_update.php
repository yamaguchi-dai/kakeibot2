<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/04/21
 * Time: 23:57
 */
include_once 'db_interface.php';
$db            = new db_interface();
$sequence_list = ['t_payment' => 'payment_seq', 'm_user' => 'user_seq', 't_budget' => 'budget_seq', 't_user_pay_category' => 'user_pay_category_seq', 'v_onetime_pass' => 'onetime_seq'];
//
//$sql = $db->load_sql('select_sequence_list.sql');
//$result = $db->exec_query($sql);
//pri('シーケンス一覧');
//pri($result);
foreach ($sequence_list as $table => $seq) {

    $sql    = $db->load_sql('select_max.sql');
    $result = $db->exec_query($sql, ['table' => $table])[0];
    pri($result);
    $sql = $db->load_sql('set_sequence.sql');
    $db->exec_query($sql, ['sequence' => "'$seq'", 'val' => $result['max'] + 1]);
}
pri('終了');
function pri($str) {
    print(print_r($str, true) . "\n");
}
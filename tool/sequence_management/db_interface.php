<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/04/22
 * Time: 0:23
 */

class db_interface {

    public $conn;

    /**
     * DBコネクター作成
     * db_interface constructor.
     */
    function __construct() {
        $ini_array = parse_ini_file("db_property.ini", true);
        $host     = $ini_array['postgres']['HOST'];
        $db_name  = $ini_array['postgres']['DATABASE'];
        $user     = $ini_array['postgres']['USERNAME'];
        $password = $ini_array['postgres']['PASSWORD'];
        $this->conn = "host=" . $host . " dbname=" . $db_name . " user=" . $user . " password=" . $password;

    }

    /**
     * SQLを実行して二次元配列として返却
     * だいたいはこれ使ってれば対応できる
     *
     * @param       $sql
     * @param array $param
     * @return array
     * @throws Exception
     */
    function exec_query($sql, $param = []) {
        $sql    = $this->replace_param($sql, $param);
        $result = $this->exec_sql($sql);
        return $this->convert_result_to_array($result);
    }

    /**
     * SQLファイル読み込み
     *
     * @param $file_name
     * @return bool|string
     * @throws
     */
    function load_sql($file_name) {
        $file = file_get_contents('./sql/' . $file_name);
        if ($file) return $file;
        throw new Exception('ファイルが存在しませんでした>>>>>' . $file_name);

    }

    /**
     * postgres取得結果を配列に置換
     *
     * @param $result
     * @return array
     */
    private function convert_result_to_array($result) {
        $return_array = [];
        for ($i = 0; $i < pg_num_rows($result); $i++) {
            $rows           = pg_fetch_array($result, NULL, PGSQL_ASSOC);
            $return_array[] = $rows;
        }
        return $return_array;

    }

    /**
     * SQL実行
     *
     * @param $sql sql実行処理
     * @return resource
     * @throws Exception 例外出力
     */
    private function exec_sql($sql) {
        $link = pg_connect($this->conn);
        if (!$link) {
            throw new Exception('接続失敗です。' . pg_last_error());
        }
        print($sql);
        $result = pg_query($sql);
        print("DBCLOSE::" . pg_close($link) . "\n");
        return $result;
    }

    /**
     * パラメータ整形処理
     * [@]文字を置換
     *
     * @param $sql
     * @param $param
     * @return mixed
     */
    private function replace_param($sql, $param) {
        foreach ($param as $key => $val) {
            $sql = str_replace('@' . $key . '@', $val, $sql);
        }
        return $sql;
    }
}
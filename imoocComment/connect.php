<?php
/**
 * 连接数据库
 * User: maosilu
 * Date: 2017/11/1
 * Time: 下午3:04
 */
$mysqli = new mysqli('localhost', 'root', '123456', 'test');
if($mysqli->errno){
    die('Connect Error:'.$mysqli->error);
}
$mysqli->set_charset('utf-8');
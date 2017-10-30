<?php
header('Content-type:text/html;charset=utf-8');
$mysqli = new mysqli('localhost', 'root', '123456', 'test');
if($mysqli->errno){
	die("connect error:".$mysqli->error);
}
$mysqli->set_charset('utf-8');
//关闭数据库的自动提交
$mysqli->autocommit(false);
$sql = "update account set money=money-200 where username='king'";
$res = $mysqli->query($sql);
$res_affect = $mysqli->affected_rows;

$sql1 = "update account set money=money+200 where username='queen'";
$res1 = $mysqli->query($sql1);
$res1_affect = $mysqli->affected_rows;

if($res && $res_affect>0 && $res1 && $res1_affect>0){
	$mysqli->commit();
	echo '转账成功！';
	$mysqli->autocommit(true);
}else{
	$mysqli->rollback();
	echo '转账失败！';
}
//关闭连接
$mysqli->close();
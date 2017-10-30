<?php 
header('Content-type:text/html;charset=utf-8');
$mysqli = new mysqli('localhost', 'root', '123456', 'test');
if($mysqli->errno){
	die("Connect Error:".$mysqli->error);
}
$mysqli->set_charset('utf-8');

$sql = "select id, username, age from user where id>=?";
$stmt = $mysqli->prepare($sql);
$id = 20;
$stmt->bind_param('i', $id);
if($stmt->execute()){
	//绑定结果集中的值到变量
	$stmt->bind_result($val1, $val2, $val3);
	//遍历结果集
	while($stmt->fetch()){
		echo '编号：'.$val1."<br/>";
		echo '姓名：'.$val2."<br/>";
		echo '年龄：'.$val3."<br/>";
		echo "<hr/>";
	}
}

$stmt->free_result();
$stmt->close();
$mysqli->close();
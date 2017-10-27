<?php
//这里是：预处理语句使用
header("content-type:text/html;charset=utf-8");
$mysqli = new mysqli('localhost', 'root', '123456', 'test');
if($mysqli->errno){
	die("Connect Error:".$mysqli->error);
}
$mysqli->set_charset('utf-8');

$sql = "INSERT user(username,password,age) values(?,?,?)";
//准备预处理语句
$stmt = $mysqli->prepare($sql);

$username = 'king';
$password = md5('king');
$age = 21;
//绑定参数
//s:字符串 i:整数 d:浮点数
$stmt->bind_param('ssi', $username, $password, $age);
//执行预处理语句
if($stmt->execute()){
	echo $stmt->insert_id;
	echo "<br/>";
}else{
	echo $mysqli->error;
}

$stmt->close();

$mysqli->close();


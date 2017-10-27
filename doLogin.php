<?php
header('content-type:text/html;charset=utf-8');
$mysqli = new mysqli('localhost', 'root', '123456', 'test');
if($mysqli->errno){
	die('Connect Error:'.$mysqli->error);
}
$mysqli->set_charset('utf-8');

$username = $_POST['username']; //举例：如果输入用户名为：' or 1=1# 就很容易引起sql注入
$password = md5($_POST['password']);

/*$sql = "select * from user where username='{$username}' AND password='{$password}'";
echo $sql;
echo "<hr/>";
$res = $mysqli->query($sql);
if($res && $res->num_rows>0){
	echo '登录成功！';
}else{
	echo '登录失败！';
}*/

//使用预处理语句防止sql注入
$sql = "select * from user where username=? AND password=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ss', $username, $password);
if($stmt->execute()){
	$stmt->store_result();
	if($stmt->num_rows > 0){
		echo '登录成功！';
	}else{
		echo '登录失败！';
	}
}

$mysqli->close();
<?php 
header('Connect-type:text/html;charset=utf-8');
$mysqli = new mysqli('localhost', 'root', '123456', 'test');
if($mysqli->errno){
	die('Connect Error:'.$mysqli->error);
}
$mysqli->set_charset('utf-8');
$sql = "select id,username, age from user;";
$sql .= "select * from users;";
$sql .= "select current_user();";
$sql .= "select now();";

//use_result()/store_result() 获取第一条查询产生的结果集
//more_results() 检测是否有更多的结果集
//next_result() 将结果集指针向下移动一位
if($mysqli->multi_query($sql)){
	do{
		if($res = $mysqli->store_result()){
			$rows[] = $res->fetch_all(MYSQLI_ASSOC); 
		}

	}while($mysqli->more_results() && $mysqli->next_result());
}else{
	echo $mysqli->errno.':'.$mysqli->error;
}

var_dump("<pre>",$rows);

//关闭连接
$mysqli->close();
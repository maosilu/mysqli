<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'test');
if($mysqli->errno){
	die("Connect Error:".$mysqli->error);
}
$mysqli->set_charset('utf-8');
$sql = "select id,username, age from user";
$res = $mysqli->query($sql);
// var_dump("<pre>",$res);
if($res && $res->num_rows>0){
	// $rows = $res->fetch_all(); //获取结果集中的所有记录，默认返回索引+索引形式的记录，等同于$res->fetch_all(MYSQLI_NUM);
	// $rows = $res->fetch_all(MYSQLI_ASSOC); //返回关联数组的形式
	// $rows = $res->fetch_all(MYSQLI_BOTH); //既有关联部分又有索引部分

	//⚠️：每fetch一次，指针就会向下移动一次，当指针移动到最后一次的时候，返回false没有结果
	/*$rows = $res->fetch_row(); //返回结果集中的一条记录，作为索引数组返回，等同于$res->fetch_array(MYSQLI_NUM);
	var_dump($rows); 
	echo "<hr/>";

	$rows = $res->fetch_assoc(); //返回结果集中的一条记录，作为关联数组返回，等同于$res->fetch_array(MYSQLI_ASSOC);
	var_dump($rows);
	echo "<hr/>";

	$rows = $res->fetch_array(); //默认返回两者都有的一条记录，等同于$res->fetch_array(MYSQLI_BOTH);
	var_dump($rows);
	echo "<hr/>";

	$rows = $res->fetch_object(); //返回结果集中的一行记录作为对象来返回，返回关联数组的形式
	var_dump($rows);
	echo "<hr/>";

	//移动结果集内部指针
	$res->data_seek(1);
	$rows = $res->fetch_assoc();
	var_dump($rows);*/

	//获取全部记录的其他方法
	while($rows = $res->fetch_assoc()){
		var_dump($rows);
		echo "<hr/>";
	}

	//释放结果集
	$res->close(); //or $res->free(); or $res->free_result;


}else{
	echo "查询错误或者结果集中没有记录";
}

//关闭连接
$mysqli->close();
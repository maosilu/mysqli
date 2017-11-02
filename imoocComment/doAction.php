<?php
header("content-type:text/html;charset=utf-8");
require_once "connect.php";
require_once "comment.class.php";
$arr = array();
$res = Comment::validate($arr);
if($res){
    $sql = "insert into comments(username,email,url,face,content,pubtime) values(?,?,?,?,?,?);";
    $stmt = $mysqli->prepare($sql);
    $arr['pubTime'] = time();
    $stmt->bind_param("sssisi", $arr['username'],$arr['email'],$arr['url'],$arr['face'],$arr['content'],$arr['pubTime']);
    $stmt->execute();
    $comment = new Comment($arr);
    echo json_encode(array('status'=>1, 'html'=>$comment->output()));
}else{
    echo '{"status":0, "errors":'.json_encode($arr).'}';
}
<?php
    header("Content-Type: text/html;charset=utf-8"); 
    $id = $_GET["id"];
    $name = $_GET["name"];
    $subject = $_GET["subject"];
    $mail = $_GET["mail"];
    $schedule = $_GET["schedule"];
    $introduce = $_GET["introduce"];
    $state = "0";//0——一面通过，1——二面通过，2——三面通过
    $result = array();
    @ $db = new mysqli('localhost','root','','student');
    mysqli_query($db,"set names 'utf8'");  
    mysqli_query($db,"set character_set_client=utf8");   
    mysqli_query($db,"set character_set_results=utf8");
    if(!$id || !$name || !$subject || !$mail || !$schedule || !$introduce){
    	$result["status"] =  "-1";
    	$result = json_encode($result);
    	echo $result;//empty
    	$db->close();
        exit;
    }
    
    //判断是否已存在
    $judge_exist = "select * from students where id = '$id'";
    $res = $db->query($judge_exist);
    if($res->num_rows){
      $result["status"] =  "1";
      $result = json_encode($result);
      echo $result;//again
      $db->close();
      exit;
    }
    //判断解析用户提示的数据,以确保这些数据不会引起程序，特别是数据库语句因为特殊字符引起的污染而出现致命的错误
    if(!get_magic_quotes_gpc()){
    	//在每个双引号（"）前添加反斜杠
    	$id = addslashes($id);
    	$name = addslashes($name);
    	$subject = addslashes($subject);
        $mail = addslashes($mail);
        $schedule = addslashes($schedule);
        $introduce = addslashes($introduce);
    }
    if(mysqli_connect_errno()){
    	echo "Error:Could not connect to database.";
    	exit;
    }
    $query = "insert into students values('".$id."','".$name."','".$subject."','".$mail."','".$schedule."','".$introduce."','".$state."')";
    $results = $db->query($query);
    $result["status"] =  "0";
    //0->success
    $result = json_encode($result);
    echo $result;
    $db->close();
?>
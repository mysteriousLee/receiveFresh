<?php 
    require("mail.php");
    header("Content-Type: text/html;charset=utf-8"); 
    $id = $_GET["id"];
    $state = $_GET["state"];
	@ $db = new mysqli('localhost','root','','student');
	mysqli_query($db,"set names 'utf8'");  
    mysqli_query($db,"set character_set_client=utf8");   
    mysqli_query($db,"set character_set_results=utf8");
	$query_user = "update students set state=$state where id=$id";
	$results = $db->query($query_user);
    $query_infor = "select * from students where id=$id";
    $result = $db->query($query_infor);
    //$num_result = $result->num_rows;
    $row = $result->fetch_assoc();
    $mail = stripslashes($row['mail']);
    //echo $mail;
    //echo $state;
    switch ($state) {
    	case '1':
    		$text = $id . "同学你好！恭喜你通过一轮面试，请于近期留意纳新消息，如有任何疑问请私信我们，谢谢";
    		email($mail,$text);
    		break;
    	case '2':
    		$text = $id . "同学你好！恭喜你通过二轮面试，请于近期留意纳新消息，如有任何疑问请私信我们，谢谢";
    		email($mail,$text);
    		break;
    	case '3':
    	    $text = $id . "同学你好！恭喜你通过三轮面试，欢迎加入3g大家族";
    	    email($mail,$text);
    	    break;
    }
	$db->close();
?>
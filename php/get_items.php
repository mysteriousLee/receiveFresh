<?php
    header("Content-Type: text/html;charset=utf-8"); 
	@ $db = new mysqli('localhost','root','','student');
	mysqli_query($db,"set names 'utf8'");  
    mysqli_query($db,"set character_set_client=utf8");   
    mysqli_query($db,"set character_set_results=utf8");
	$query_user = "select * from students;";
	$results = $db->query($query_user);
	$num_result = $results->num_rows;
	$arr = array();
	if($num_result == 0){
		$arr["status"] = "1";//error
		$result = array();
		$result["length"] = "0";
	    $result = (object)$result;
	    $arr["result"] = $result;
	    $arr = json_encode($arr);
		echo $arr;
		$db->close();
		exit;
	}
	$arr["status"] = "0";
	$result = array();
	$len = 0;
	for($i = 0;$i < $num_result; $i++){
		$row = $results->fetch_assoc();
		//删除反斜杠
		//echo stripslashes($row['id']);
		$id = stripslashes($row['id']);
		$name = stripslashes($row['name']);
		$subject = stripslashes($row['subject']);
		$schedule = stripslashes($row['schedule']);
		$mail = stripslashes($row['mail']);
		$state = stripslashes($row['state']);
        $item = array(
        "id" => $id,
        "name" => $name,
        "subject" => $subject,
        "schedule" => $schedule,
        "mail" => $mail,
        "state" => $state
        	);
        array_push($result,$item);
        $len += 1;
	}
	$result["length"] = $len;
	$result = (object)$result;
	$arr["result"] = $result;
	$arr = json_encode($arr);
	echo $arr;
	$db->close();
?>
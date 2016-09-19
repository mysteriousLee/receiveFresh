<?php
	 require("smtp.php");
	 function email($address,$text){
	 	$smtpserver = "smtp.163.com";
	 	$smtpserver_port = 25;
	 	$smtpusermail = "13759880513@163.com";
	 	$smtpemail_to = $address;
	 	$smtp_user = '13759880513';
	 	$smtp_password = 'lulu@1101';
	 	$mail_title = "php小测试";
	 	$mail_content = $text;
	 	$mail_type = 'TXT';
	 	$smtp = new smtp($smtpserver,$smtpserver_port,true,$smtp_user,$smtp_password);
	 	$smtp->debug = false;
	 	$smtp->sendmail($smtpemail_to, $smtpusermail, $mail_title, $mail_content, $mail_type);
	 }
?>
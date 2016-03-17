<?php
	$params = $_POST;
	$headers = 'MIME-Version: 1.0'."\r\n";
	$headers.= 'Content-type:text/html;charset=UTF-8'."\r\n";
	$headers.= 'From: Pojok Webdev<puji@padi.net.id>'."\r\n";
	$headers.= 'Cc: <pw.prayitno@gmail.com>'."\r\n";
	mail($params["mailto"],$params["mailsubject"],$params["mailcontent"],$headers);
?> 

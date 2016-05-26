<?php 
	$connect = @mysql_connect('localhost', 'root', '34862365');
	$db_con = @mysql_select_db("today", $connect) or die("Fail");
?>
<?php 
//데이터베이스에 연결
	$connect = @mysql_connect('localhost', 'root', '34862365');
	$db_con = @mysql_select_db("today", $connect) or die("Fail");
?>
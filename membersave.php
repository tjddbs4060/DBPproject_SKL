﻿<?php
	require("connect_today.php");

	$id=$_GET['newid'];
	$password=$_GET['newpwd'];
	$mail=$_GET['mail'];
	$phonenum=$_GET['phonenum'];
	$year=$_GET['year'];
	$month=$_GET['month'];
	$day=$_GET['day'];

	if($month<10)
		$month="0".$month;

	if($day<10)
		$day="0".$day;

	$total="$year$month$day";

	$sql = "insert into user (id, password, e_mail, phone_num, birthday) values ('$id', '$password', '$mail', '$phonenum', '$total' )";

	$check = "select * from user where id='$id'";
    $result = mysql_query($check);
    $row = mysql_fetch_row($result);

	if(empty($id) || empty($password)){
		if(empty($id) && empty($password))
			echo "<script>alert('아이디/비밀번호가 입력되지 않았습니다.'); history.go(-1);</script>";
		else if(empty($id))
			echo "<script>alert('아이디가 입력되지 않았습니다.'); history.go(-1);</script>";
		else
			echo "<script>alert('비밀번호가 입력되지 않았습니다.'); history.go(-1);</script>";
	}

	else if(strcmp($id, $row[0]) == 0)
		echo "<script>alert('동일한 아이디가 존재합니다.'); history.go(-1);</script>";

	else if(isset($id) && isset($password)){
			mysql_query($sql);
			mysql_query("insert into friend (id, id_friend, accept) values ('$id', '$id', 'TRUE')");
			mysql_query("insert into anniversary (anni_year, anni_mon, anni_day, content, id) values (".$_GET['year'].", ".$_GET['month'].", ".$_GET['day'].", 'birthday ~ ', '$id')");
			echo "<script>alert('축하합니다!');window.location.replace('login.php');</script>";
	}
?>
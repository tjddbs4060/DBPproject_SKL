<?php

include "connect_today.php";

session_start();

if (!$_GET['friend']) echo "<script> alert('아이디를 입력해주세요.'); window.location.replace('friend_ask.php'); </script>";

$query = "select u.id from user as u, friend as f where u.id = '".$_GET['friend']."' and ((f.id = u.id and f.id_friend = '".$_SESSION['userid']."') or (f.id = '".$_SESSION['userid']."' and f.id_friend = u.id))";
$result = mysql_query($query);

if ($ask = mysql_fetch_assoc($result))
	echo "<script> alert('존재하지 않는 아이디이거나 친구 요청 및 신청된 친구입니다.'); window.location.replace('friend_ask.php'); </script>";
else {
	$query = "select id from user where id = '".$_GET['friend']."'";
	$result = mysql_query($query);
	if ($_SESSION['userid'] != $_GET['friend'] && mysql_fetch_assoc($result)) {
		mysql_query("insert into friend (id, id_friend, accept) values ('".$_SESSION['userid']."', '".$_GET['friend']."', 'FALSE')");

		@mysql_close();
		echo "<script> alert('친구 신청되엇습니다.'); window.location.replace('friend_ask.php'); </script>";
	}
	else echo "<script> alert('잘못된 아이디를 입력하였습니다.'); window.location.replace('friend_ask.php'); </script>";
}

?>
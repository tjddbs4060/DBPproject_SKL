<?php

include "connect_today.php";

session_start();

if (!$_GET['friend']) echo "<script> alert('���̵� �Է����ּ���.'); window.location.replace('friend_ask.php'); </script>";

$query = "select u.id from user as u, friend as f where u.id = '".$_GET['friend']."' and ((f.id = u.id and f.id_friend = '".$_SESSION['userid']."') or (f.id = '".$_SESSION['userid']."' and f.id_friend = u.id))";
$result = mysql_query($query);

if ($ask = mysql_fetch_assoc($result))
	echo "<script> alert('�������� �ʴ� ���̵��̰ų� ģ�� ��û �� ��û�� ģ���Դϴ�.'); window.location.replace('friend_ask.php'); </script>";
else {
	$query = "select id from user where id = '".$_GET['friend']."'";
	$result = mysql_query($query);
	if ($_SESSION['userid'] != $_GET['friend'] && mysql_fetch_assoc($result)) {
		mysql_query("insert into friend (id, id_friend, accept) values ('".$_SESSION['userid']."', '".$_GET['friend']."', 'FALSE')");

		@mysql_close();
		echo "<script> alert('ģ�� ��û�Ǿ����ϴ�.'); window.location.replace('friend_ask.php'); </script>";
	}
	else echo "<script> alert('�߸��� ���̵� �Է��Ͽ����ϴ�.'); window.location.replace('friend_ask.php'); </script>";
}

?>
<?php
//connect_today.php �ε�
include "connect_today.php";
session_start();

//������ �Է��ϸ� ����, �Է����� ������ alert ���
if ($_GET['content']) add_anni($_GET['value'], $_GET['content']);
else {
	@mysql_close();
	echo "<script> alert('������� �Է����ּ���.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function add_anni($date_now, $content) {
	$query = "insert into anniversary (anni_year, anni_mon, anni_day, content, id) values (".$_GET['year'].", ".$_GET['mon'].", ".$_GET['day'].", '$content', '".$_SESSION['userid']."')";
	mysql_query($query);

	@mysql_close();

//�������� ���� �� alert ���
	echo "<script> alert('������� �߰��Ǿ����ϴ�.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}
?>

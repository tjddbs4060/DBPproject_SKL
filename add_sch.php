<?php
//connect_today.php �ε�
include "connect_today.php";
session_start();

//������ ������ ���� ������ alert ���
if ($_GET['s_hour'] > $_GET['f_hour'] || ($_GET['s_minute'] > $_GET['f_minute'] && $_GET['s_hour'] == $_GET['f_hour'])) {
	@mysql_close();
	echo "<script> alert('���۽ð��� ����ð����� ��ϴ�.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}
else if ($_GET['content']) add_content($_GET['value'], $_GET['content']);
else {
	@mysql_close();
	echo "<script> alert('������ �Է����ּ���.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function add_content($date_now, $content) {

//�޾ƿ� ��¥ ���� ��, ���� ���� ���ڸ��̸� ���ڸ��� �÷���
	$date_now = explode("-", $date_now);
	$s_hour = (int)$_GET['s_hour'];
	$s_minute = (int)$_GET['s_minute'];
	$f_hour = (int)$_GET['f_hour'];
	$f_minute = (int)$_GET['f_minute'];
	if ($date_now[1] < 10) $date_now[1] = "0".$date_now[1];
	if ($date_now[2] < 10) $date_now[2] = "0".$date_now[2];
	if ($s_hour < 10) $s_hour = "0".$s_hour;
	if ($s_minute < 10) $s_minute = "0".$s_minute;
	if ($f_hour < 10) $f_hour = "0".$f_hour;
	if ($f_minute < 10) $f_minute = "0".$f_minute;

	$query = "insert into schedule (id, friend_range, cheer_num, sch_date, sch_start_time, sch_finish_time, content) values ('".$_SESSION['userid']."', ".$_GET['range'].", 0, $date_now[0]$date_now[1]$date_now[2], ".$s_hour.$s_minute."00, ".$f_hour.$f_minute."00, '$content')";
	mysql_query($query);

	@mysql_close();

//������ ���� �߰� �� alert ���
	echo "<script> alert('������ �߰��Ǿ����ϴ�.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}
?>

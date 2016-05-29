<?php

include "connect_today.php";

if ($_GET['content']) add_content($_GET['value'], $_GET['content']);
else {
	@mysql_close();
	echo "<script> alert('일정을 입력해주세요.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function add_content($date_now, $content) {
	$date_now = explode("-", $date_now);
	if ($date_now[1] < 10) $date_now[1] = "0".$date_now[1];
	if ($date_now[2] < 10) $date_now[2] = "0".$date_now[2];

	$query = "insert into schedule (id, friend_range, cheer_num, sch_date, content) values ('qwer', 1, 0, $date_now[0]$date_now[1]$date_now[2], '$content')";
	mysql_query($query);

	@mysql_close();

	echo "<script> alert('일정이 추가되었습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}
?>

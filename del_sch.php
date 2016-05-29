<?php

include "connect_today.php";

if (is_int(key($_GET))) del_sch();
else {
	@mysql_close();
	echo "<script> alert('일정을 선택해주세요.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function del_sch() {
	reset($_GET);
	while (is_int(key($_GET))) {
		$query = "delete from schedule where sch_date = '".$_GET['value']."' and content = '".$_GET[key($_GET)]."';";	//id 추가할거
		mysql_query($query);
		next($_GET);
	}

	@mysql_close();

	echo "<script> alert('일정이 삭제되었습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

?>
<?php

include "connect_today.php";

if (count($_GET) > 1) del_sch();
else {
	@mysql_close();
	echo "<script> alert('일정을 선택해주세요.'); window.location.replace('Calendar.php?value=".$_GET['value']."');</script>";
}

function del_sch() {
	for ($i = 0; $i < count($_GET)-1; $i++) {
		$query = "delete from schedule where sch_date = '".$_GET['value']."' and content = '".$_GET[$i]."';";	//id 추가할거
		mysql_query($query);
	}

	@mysql_close();

	echo "<script> alert('일정이 삭제되었습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."');</script>";
}

?>
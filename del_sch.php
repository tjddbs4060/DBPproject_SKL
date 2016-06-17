<?php
//connect_today.php 로드
include "connect_today.php";

//일정을 선택하지 않으면 실행하지 않고 선택하면 실행
if ($_GET['index']) del_sch();
else {
	@mysql_close();
	echo "<script> alert('일정을 선택해주세요.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function del_sch() {
//받아온 값이 일정이면 살제 실행
	$query = "delete from schedule where sch_index = '".$_GET['index']."'";	//id 추가할거
	mysql_query($query);

	@mysql_close();

	echo "<script> alert('일정이 삭제되었습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

?>
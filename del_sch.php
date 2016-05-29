<?php
//connect_today.php 로드
include "connect_today.php";

//일정을 선택하지 않으면 실행하지 않고 선택하면 실행
if (is_int(key($_GET))) del_sch();
else {
	@mysql_close();
	echo "<script> alert('일정을 선택해주세요.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function del_sch() {
//받아온 값의 배열의 맨 앞부터 시작
	reset($_GET);
//받아온 값이 일정이면 살제 실행
	while (is_int(key($_GET))) {
		$query = "delete from schedule where sch_date = '".$_GET['value']."' and sch_index = '".$_GET[key($_GET)]."';";	//id 추가할거
		mysql_query($query);
		next($_GET);
	}

	@mysql_close();

	echo "<script> alert('일정이 삭제되었습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

?>
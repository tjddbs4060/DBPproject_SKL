<?php
//connect_today.php 로드
include "connect_today.php";

if ($_GET['index']) del_anni();
else {
	@mysql_close();
	echo "<script> alert('기념일이 존재하지 않습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function del_anni() {
//해당 인덱스 기념일 삭제
	$query = "delete from anniversary where anni_index = ".$_GET['index'];	//id 추가할거
	mysql_query($query);

	@mysql_close();

	echo "<script> alert('기념일이 삭제되었습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

?>
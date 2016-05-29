<?php
//connect_today.php 로드
include "connect_today.php";

//내용을 입력하면 실행, 입력하지 않으면 alert 출력
if ($_GET['content']) add_anni($_GET['value'], $_GET['content']);
else {
	@mysql_close();
	echo "<script> alert('기념일을 입력해주세요.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function add_anni($date_now, $content) {
	$query = "insert into anniversary (anni_year, anni_mon, anni_day, content) values (".$_GET['year'].", ".$_GET['mon'].", ".$_GET['day'].", '$content')";
	mysql_query($query);

	@mysql_close();

//쿼리문에 저장 후 alert 출력
	echo "<script> alert('기념일이 추가되었습니다.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}
?>

<?php
	session_start();
	if(isset($_SESSION['userid'])){
		session_destroy();
		echo "<script> alert('로그아웃 합니다.'); window.location.replace('login.php');</script>";
	}
	else
		echo "<script> alert('오류가 발생했습니다.'); window.location.replace('login.php');</script>";
?>
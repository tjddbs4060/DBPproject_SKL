<?php
	require("connect_today.php");
	session_start();
	
	$index = $_GET['index'];
	$date = $_GET['date'];
	$start = $_GET['start'];
	$finish = $_GET['finish'];
	$content = $_GET['content'];
	$range = $_GET['range'];

	$query_check = "select sch_start_time, sch_finish_time, content from schedule where id = '".$_SESSION['userid']."' and sch_date = '".$date."'";
	$result_check = mysql_query($query_check);

	$bol_check = true;
	while($check_row = mysql_fetch_assoc($result_check)) {
		if($check_row['sch_start_time'] == '00:00:00' && $check_row['sch_finish_time'] =='00:00:00'){
			if($check_row['content'] == $content) {
				$bol_check = false;
			}
			continue;
		}
		else if(!(($check_row['sch_start_time'] > $start && $check_row['sch_start_time'] > $finish) || ($check_row['sch_finish_time'] < $start && $check_row['sch_finish_time'] < $finish))) {
			$bol_check = false;
		}
	}
	if($bol_check) {
		$query_tryTF = "select id from entry where sch_index = ".$index." and id ='".$_SESSION['userid']."'";
		$result_tryTF = mysql_query($query_tryTF);
		if(!mysql_num_rows($result_tryTF)) {
			$query_tryinsert = "insert into entry (sch_index, id) values (".$index.", '".$_SESSION['userid']."' )";
			$result_tryinsert = mysql_query($query_tryinsert);
	
			echo "<script>alert(\"일정이 추가되었습니다.\");</script>";
		}				
		else {
			$query_trydelete = "delete from entry where id= '".$_SESSION['userid']."'";
			$result_trydelete = mysql_query($query_trydelete);

			echo "<script>alert(\"일정이 삭제되었습니다.\");</script>";
		}
	}
	else {
		echo "<script>alert(\"일정이 겹쳐서 추가할 수 없습니다.\");</script>";
	}
	@mysql_close();
	$url = "main.php'";
	echo "<meta http-equiv='Refresh' content='0; URL=$url>"; 
?>
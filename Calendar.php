<?php require("connect_today.php"); ?>

<!DOCTYPE>
<html>
<head> <title> 달력 페이지</title> </head>
<body>

<script type = "text/javascript" src = "today.js"> </script>

<h1> 일정 관리 페이지 </h1>

<div id = "Cal" align = "left" style = "position : relative; width : 750px;"> </div>

<div id = "View" align = "left" style = "position : relative; left : 750px; width : 300px; border : thin solid black; padding-left : 20px; padding-right : 20px;">

<h3 style = "text-align : center"> 일정 목록 </h3>

<?php
if ($_GET['value']) display_list($_GET['value']);

function display_list($date_now) {
	$query = "select content from schedule where sch_date = '$date_now'";	//아이디 추가되면 where 뒤에 추가할 것
	$result = mysql_query($query);
	$arr_list = mysql_fetch_assoc($result);

	$div_string = "<h3 style = 'text-align : center'> <b>- ".$_GET['value']." -</b> </h3>";

	if ($arr_list) {
		foreach($arr_list as $put) {
			$div_string .= $put;
			$div_string .= "<p>";
		}
		unset($put);
	}

	$div_string .= "<br>";
	$div_string .= "<div style = \"background-image : url('test.png'); width : 100px; height : 50px; margin : 0 auto;\" onclick = ''> </div>";	//수정 페이지로 넘어가는 버튼
	$div_string .= "<br><p>";

	echo $div_string;
}
?>

</div>

<?php @mysql_close(); ?>
</body>
</html>
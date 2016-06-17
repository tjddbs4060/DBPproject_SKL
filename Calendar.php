﻿<?php require("connect_today.php"); session_start(); ?>

<!DOCTYPE>
<html>
<head> <meta charset="utf-8"> <title> 일정 관리 페이지 </title> </head>
<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>
<body style = "background-color : #f0f0f0; margin : 0 auto;">

<script type = "text/javascript" src = "Calendar.js"> </script>

<?php
//php문으로 html에 자바스크립트를 출력하여 자바스크립트처럼 사용
$string = '<script type = "text/javascript">';

//페이지가 뜨면 자동으로 실행되는 함수
$string .= 'window.onload = function() {';

//받아온 값을 Calendar.js 파일에 있는 전역변수에 저장
$string .= "ymd = '".$_GET['value']."';";
$string .= "y_now = ".$_GET['Y'].";";
$string .= "m_now = ".$_GET['M'].";";

$string .= 'Calendar("Cal");';
$string .= '}';
$string .= '</script>';

echo $string;

//해당하는 id(아직 안함)와 없는 id의 모든 기념일의 정보 저장
$query = "select * from anniversary where id is null or id = '".$_SESSION['userid']."' order by anni_mon, anni_day";
$result = mysql_query($query);

$string = "<script type = 'text/javascript'>";
$string .= "function anni_col() {";

//저장한 정보를 anni라는 변수에 배열로 저장
$string .= "var anni = new Array(";

//저장한 기념일의 정보를 한줄씩 출력하여 배열에 순서대로 저장
while ($list = mysql_fetch_assoc($result))
	$string .= $list['anni_mon'].", ".$list['anni_day'].",'".$list['content']."',";


//배열의 마지막의 ,(콤마)를 제거
$string = substr($string, 0, strlen($string)-1);
$string .= ");";
$string .= "return anni;";

$string .= "} </script>";

echo $string;

$last_day = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);	//월에대한 일들
if (($_GET['Y']%4 == 0 && $_GET['Y']%100) || $_GET['Y']%400 == 0) $last_day[1] = 29;

$string = "<script type = 'text/javascript'>";
$string .= "function sch_num_col() {";

$string .= "var sch_num = new Array(";

//달력에 출력되어 있는 달의 일정 갯수들을 모두 저장
for ($i = 1; $i <= $last_day[$_GET['M']-1]; $i++) {
	$query = "select * from schedule where id = '".$_SESSION['userid']."' and sch_date = '".$_GET['Y']."-".$_GET['M']."-".$i."'";
	$result = mysql_query($query);
	$count = 0;

//일정 갯수를 하나하나 확인
	while ($list = mysql_fetch_row($result)) $count++;

	$string .= "$count,";
}
$string = substr($string, 0, strlen($string)-1);

$string .= ");";
$string .= "return sch_num; } </script>";

echo $string;
?>

<table width = "100%" class = "main"> <tr> <td>
	<div style = "text-align : left; margin-left : 20px;">
		<img src = "img/logo.png" width = "100px" height = "50px">
	</div> </td>
	<td align : right> <div style = "text-align : right; margin-right : 20px;">
		<img src = "img/home.png" width = "50px" height = "50px" onclick = "window.location.replace('main.php');">
		<img src = "img/friend_menu.png" width = "50px" height = "50px" onclick = "window.location.replace('friend_main.php')">
		<img src = "img/sch_menu.png" width = "50px" height = "50px" onclick = "window.location.reload();" >
		<img src = "img/Logout(default).png" width = "50px" height = "50px" onclick = "window.location.replace('logout.php')" onmouseover = "this.src = 'img/Logout(over).png';" onmouseout = "this.src = 'img/Logout(default).png';">
</div> </td> </tr> </table>

<table style = "margin : 0 auto;"> <tr> <td valign = "top">
<div id = "Cal" align = "left" style = "background-image : url('img/Cal.png'); position : relative; width : 730px; background-repeat : no-repeat; margin-right : 30px"> </div> </td>
<td valign = "top"> <table> <tr> <td colspan = "3"> <div style = "background-image : url('img/V.png'); height : 50px; margin-bottom : 10px"> </div> </td> </tr> 
<tr> <td colspan = "3">
<div id = "View" align = "left" style = "background-color : #ffffff; position : relative; width : 300px; border : 3px solid #5ac7db; padding-left : 20px; padding-right : 20px; word-wrap : break-word;">

<?php
//전달되어있는 value 값이 있으면 실행
if ($_GET['value']) display_list($_GET['value']);

//일정 내용 확인하는 함수
function display_list($date_now) {
//해당하는 날과 id(미구현)를 확인하여 일정 출력
	$query = "select * from schedule where id = '".$_SESSION['userid']."' and sch_date = '$date_now' order by sch_start_time";	//아이디 추가되면 where 뒤에 추가할 것
	$result = mysql_query($query);
	$i = 0;

	$div_string = "<h3 style = 'text-align : center; font-family : serif;'> <b>< ".$_GET['value']." ></b> </h3>";
//일정 출력
	while ($arr_list = mysql_fetch_assoc($result)) {
		if (!$i) $div_string .= "<table class = 'sch' style = 'width : 300px;'>";
		if ($arr_list['friend_range']) $div_string .= "<tr> <td onclick = 'window.location.replace(\"check_sch.php?index=".$arr_list['sch_index']."\");' style = 'max-width : 270px; word-wrap : break-word;'> <font class = 'small'>".$arr_list['sch_start_time']." ~ ".$arr_list['sch_finish_time']." / ";
		else $div_string .= "<tr> <td style = 'max-width : 270px; word-wrap : break-word;'> <font class = 'small'>".$arr_list['sch_start_time']." ~ ".$arr_list['sch_finish_time']." / ";

		switch($arr_list['friend_range']) {
			case 0 : $div_string .= "나만보기"; break;
			case 1 : $div_string .= "친구에게만"; break;
			case 2 : $div_string .= "모두에게"; break;
			default : break;
		}

		$div_string .= "</font><br>".$arr_list['content']."</td> <td style = 'text-align : right; width : 30px;'>";
		$div_string .= "<img src = 'img/delete(default).png' onclick = 'window.location.replace(\"del_sch.php?value=".$_GET['value']."&index=".$arr_list['sch_index']."&Y=".$_GET['Y']."&M=".$_GET['M']."\");' onmouseover = 'this.src = \"img/delete(over).png\";' onmouseout = 'this.src = \"img/delete(default).png\";'>";
		$div_string .= "</td> <tr style = 'height : 10px'> </tr> </tr>";
		$i = 1;
	}
	if ($i) $div_string .= "</table>";

	$div_string .= "</td> </tr> <tr style = 'height : 20px'> </tr>";

//해당하는 날의 기념일을 확인
	$spl_date = explode("-", $date_now);
	$query = "select * from anniversary where (id = '".$_SESSION['userid']."' or id is null) and anni_mon = ".$spl_date[1]." and anni_day = ".$spl_date[2]." order by id";
	$result = mysql_query($query);

//기념일이 있다면 출력
	if (mysql_fetch_assoc($result)) {
		$result = mysql_query($query);
		$div_string .= "<tr> <td colspan = '3'> <div style = 'background-image : url(\"img/congration.png\"); height : 50px;'> </div> </td> </tr>";

		$div_string .= '<tr> <td colspan = "3"> <div class = "sch" style = "background-color : #ffffff; width : 300px; border : 3px solid #5ac7db; padding : 20px; word-wrap : break-word; line-height : 25px;">';
		$i = 0;

		while ($arr_list = mysql_fetch_assoc($result)) {
			if (!$i) $div_string .= "<table class = 'sch' style = 'width : 300px;'>";

			if ($arr_list['id'] == null) $div_string .= "<tr> <td style = 'max-width : 270px; word-wrap : break-word;'>".$arr_list['content']."</td> <td style = 'text-align : right; width : 30px;'>";
			else $div_string .= "<tr> <td style = 'max-width : 270px; word-wrap : break-word;'> <font class = 'small'>".$arr_list['anni_year']."-".$arr_list['anni_mon']."-".$arr_list['anni_day']."<br> </font>".$arr_list['content']."</td> <td style = 'text-align : right; width : 30px;'>";

			if ($arr_list['id'] != null) $div_string .= "<img src = 'img/delete(default).png' onclick = 'window.location.replace(\"del_anni.php?value=".$_GET['value']."&index=".$arr_list['anni_index']."&Y=".$_GET['Y']."&M=".$_GET['M']."\");' onmouseover = 'this.src = \"img/delete(over).png\";' onmouseout = 'this.src = \"img/delete(default).png\";'>";
			$div_string .= "</td> <tr style = 'height : 10px'> </tr> </tr>";
			$i = 1;
		}
		if ($i) $div_string .= "</table>";
	}

	$div_string .= "<tr style = 'margin : 0 auto'> <td>";
	$div_string .= "<img src = 'img/sch(default).png' onclick = 'add_sch();' onmouseover = 'this.src = \"img/sch(over).png\";' onmouseout = 'this.src = \"img/sch(default).png\";'> </td>";	//수정 페이지로 넘어가는 버튼
	$div_string .= "<input type = 'hidden' name = 'value' value = '$date_now'>";
	$div_string .= "<input type = 'hidden' name = 'Y' value = ".$_GET['Y'].">";
	$div_string .= "<input type = 'hidden' name = 'M' value = ".$_GET['M'].">";
	$div_string .= "<td width = '70px'> </td>";
	$div_string .= "<td> <img src = 'img/anni(default).png' onclick = 'add_anni();' onmouseover = 'this.src = \"img/anni(over).png\";' onmouseout = 'this.src = \"img/anni(default).png\";'> </td>";
	$div_string .= "</tr> </table>";

	echo $div_string;
}

?>

</div> </td> </tr> </table>

<div id = "Add" style = "background-color : #ffffff; position : absolute; left : 400px; top : 200px; width : 400px; padding : 10px; border : thin solid black; word-wrap:break-word; visibility : hidden;">

<form method = "get" action = "add_sch.php">

<input type = "hidden" name = "value" value = "<?php echo $_GET['value']; ?>">
<input type = "hidden" name = "Y" value = "<?php echo $_GET['Y']; ?>">
<input type = "hidden" name = "M" value = "<?php echo $_GET['M']; ?>">
<table class = "normal" border = "1px">
<tr> <td> <div style = "width : 50px; text-align : center"> 시작 시간 </div> </td> <td style = "text-align : center;">

<?php

$string = "<select class = 'normal' name = 's_hour' style = 'background : none;'>";
for ($i = 0; $i < 24; $i++) {
	$string .= "<option class = 'normal' value = '$i'>";
	if ($i == 0) $string .= "AM 12 시 </option>";
	else if ($i/12 < 1) $string .= "AM $i 시 </option>";
	else if ($i == 12) $string .= "PM $i 시 </option>";
	else $string .= "PM ".($i%12)." 시 </option>";
}
$string .= "</select>&nbsp&nbsp";

$string .= "<select class = 'normal' name = 's_minute' style = 'background : none;'>";
for ($i = 0; $i < 60; $i++)
	$string .= "<option class = 'normal' value = '$i'> $i 분 </option>";
$string .= "</select>";

echo $string;

?>

</td> </tr>
<tr> <td> <div style = "width : 50px; text-align : center"> 종료 시간 </div> </td> <td style = "text-align : center;">

<?php

$string = "<select class = 'normal' name = 'f_hour' style = 'background : none;'>";
for ($i = 0; $i < 24; $i++) {
	$string .= "<option class = 'normal' value = '$i'>";
	if ($i == 0) $string .= "AM 12 시 </option>";
	else if ($i/12 < 1) $string .= "AM $i 시 </option>";
	else if ($i == 12) $string .= "PM $i 시 </option>";
	else $string .= "PM ".($i%12)." 시 </option>";
}
$string .= "</select>&nbsp&nbsp";

$string .= "<select class = 'normal' name = 'f_minute' style = 'background : none;'>";
for ($i = 0; $i < 60; $i++)
	$string .= "<option class = 'normal' value = '$i'> $i 분 </option>";
$string .= "</select>";

echo $string;

?>

</td> </tr>

<tr> <td> <div style = "width : 50px; text-align : center"> 일정 내용 </div> </td> <td>
<textarea name = "content" rows = "6" cols = "43" style = "background-color : transparent; border : none;"></textarea>

</td> </tr> <tr class = 'normal'> <td> <div style = "width : 60px; text-align : center;"> 공개 범위 설정 </div> </td> <td style = "text-align : center;">
<select name = "range" style = "background : none;">
<option value = "0"> 나만 보기 </option>
<option value = "1"> 친구에게만 </option>
<option value = "2"> 모두에게 </option> </td></tr> </table>

<table style = "margin : 0 auto;"> <tr> <td>

<img src = "img/cancle(default).png" onclick = "document.getElementById('Add').style.visibility = 'hidden';" onmouseover = "this.src = 'img/cancle(over).png';" onmouseout = "this.src = 'img/cancle(default).png';"> </td>

<td> </td> <td>

<input type = "image" src = "img/add(default).png" onmouseover = "this.src = 'img/add(over).png';" onmouseout = "this.src = 'img/add(default).png';"> </td> </table>
</form> </div>

<div id = "Anni" style = "background-color : #ffffff; position : absolute; left : 400px; top : 300px; width : 400px; padding : 10px; border : thin solid black; word-wrap:break-word; visibility : hidden">
<table class = "normal" border = "1px">
<form method = "get" action = "add_anni.php">
<tr> <td> <div style = "width : 60px; text-align : center;"> 날짜<br>입력 </div> </td> <td style = "text-align : center;">
<?php
//select문 출력(년/월/일)
$string = "<select class = 'normal' name = 'year' style = 'background : none;'>";
for ($i = $_GET['Y']-30; $i < $_GET['Y']+30; $i++)
	$string .= "<option class = 'normal' value = '$i'> $i </option>";
$string .= "</select>&nbsp&nbsp";

$string .= "<select class = 'normal' name = 'mon' style = 'background : none'>";
for ($i = 1; $i <= 12; $i++)
	$string .= "<option class = 'normal' value = '$i'> $i </option>";
$string .= "</select>&nbsp&nbsp";

$string .= "<select class = 'normal' name = 'day' style = 'background : none'>";
for ($i = 1; $i <= 31; $i++)
	$string .= "<option class = 'normal' value = '$i'> $i </option>";
$string .= "</select>";

echo $string;

?>
</td> </tr> <tr> <td>
<input type = "hidden" name = "value" value = "<?php echo $_GET['value']; ?>">
<input type = "hidden" name = "Y" value = "<?php echo $_GET['Y']; ?>">
<input type = "hidden" name = "M" value = "<?php echo $_GET['M']; ?>">
<div style = "width : 60px; text-align : center;"> 기념일 내용 </div> </td> <td>
<input type = "text" name = "content" size = "41" style = "background-color : transparent; border : none;">
</td> </tr> </table>

<table style = "margin : 0 auto;"> <tr> <td>

<img src = "img/cancle(default).png" onclick = "document.getElementById('Anni').style.visibility = 'hidden';" onmouseover = "this.src = 'img/cancle(over).png';" onmouseout = "this.src = 'img/cancle(default).png';"> </td>

<td> </td> <td>
<input type = "image" src = "img/add(default).png" onmouseover = "this.src = 'img/add(over).png';" onmouseout = "this.src = 'img/add(default).png';"> </td> </table>
</form> </div>


<?php @mysql_close(); ?>
</body>
</html>
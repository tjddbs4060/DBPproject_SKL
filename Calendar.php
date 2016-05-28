<?php require("connect_today.php"); ?>

<!DOCTYPE>
<html>
<head> <title> 일정 관리 페이지 </title> </head>
<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>
<body style = "background-image : url('img/background.png'); background-repeat : repeat-x;">

<script type = "text/javascript" src = "Calendar.js"> </script>
<?php
$string = '<script type = "text/javascript">';
$string .= 'window.onload = function() {';

$date_now = explode("-", $_GET['value']);
//if ($date_now[1] < 10) $date_now[1] = "0".$date_now[1];
//if ($date_now[2] < 10) $date_now[2] = "0".$date_now[2];
$date_ym = "$date_now[0], $date_now[1]-1";

$string .= "d = new Date($date_ym);";
$string .= 'Calendar("Cal");';
$string .= '}';
$string .= '</script>';

echo $string;

$query = "select * from anniversary where id is null order by anni_mon, anni_day";
$result = mysql_query($query);

$string = "<script type = 'text/javascript'>";
$string .= "function anni_col() {";

$string .= "var anni = new Array(";

while ($list = mysql_fetch_assoc($result))
	$string .= $list['anni_mon'].", ".$list['anni_day'].",'".$list['content']."',";
$string = substr($string, 0, strlen($string)-1);
$string .= ");";
$string .= "return anni;";

$string .= "} </script>";

echo $string;

?>

<table style = "margin : 0 auto;"> <tr> <div style = "height : 130px"> <td valign = "top">
<div id = "Cal" align = "left" style = "background-image : url('img/달력.png'); position : relative; width : 750px;"> </div> </td>
<td valign = "top"> <table> <tr> <td colspan = "3"> <div style = "background-image : url('img/V.png'); height : 50px; margin-bottom : 10px"> </div> </td> </tr> 
<tr> <td colspan = "3">
<div id = "View" align = "left" style = "position : relative; width : 300px; border : 3px solid #ff4949; padding-left : 20px; padding-right : 20px; word-wrap:break-word;">

<?php

if ($_GET['value']) display_list($_GET['value']);

function display_list($date_now) {
	$query = "select content from schedule where sch_date = '$date_now'";	//아이디 추가되면 where 뒤에 추가할 것
	$result = mysql_query($query);
	$i = 0;

	$div_string = "<h3 style = 'text-align : center; font-family : serif;'> <b>- ".$_GET['value']." -</b> </h3>";

	while ($arr_list = mysql_fetch_assoc($result)) {
		if (!$i) $div_string .= "<form class = 'sch' id = 'menu' method = 'GET' action = 'del_sch.php'>";
		$div_string .= $arr_list['content']."<input type = 'checkbox' name = '$i' value = '".$arr_list['content']."' style = 'float : right;'> <br>";
		$i++;
	}

	$div_string .= "<br> </td> </tr> <tr style = 'margin : 0 auto'> <td>";
	$div_string .= "<img src = 'img/일정추가(일반).png' onclick = 'add_sch();' onmouseover = 'this.src = \"img/일정추가(오버).png\";' onmouseout = 'this.src = \"img/일정추가(일반).png\";' onmousedown = 'this.src = \"img/일정추가(클릭).png\";' onmouseup = 'this.src = \"img/일정추가(오버).png\";'> </td>";	//수정 페이지로 넘어가는 버튼
	$div_string .= "<input type = 'hidden' name = 'value' value = '$date_now'>";
	if (!$i) $div_string .= "<td width = '135px'> </td>";
	$div_string .= "<td> <img class = 'b' src = 'img/기념일(일반).png' onclick = 'add_anni();' onmouseover = 'this.src = \"img/기념일(오버).png\";' onmouseout = 'this.src = \"img/기념일(일반).png\";' onmousedown = 'this.src = \"img/기념일(클릭).png\";' onmouseup = 'this.src = \"img/기념일(오버).png\";'> </td>";
	if ($i) $div_string .= "<td> <input type = 'image' src = 'img/선택일정(일반).png' onmouseover = 'this.src = \"img/선택일정(오버).png\";' onmouseout = 'this.src = \"img/선택일정(일반).png\";' onmousedown = 'this.src = \"img/선택일정(클릭).png\";' onmouseup = 'this.src = \"img/선택일정(오버).png\";'> </form> </td> </tr> </table>";
	else $div_string .= "</tr> </table>";

	echo $div_string;
	print_r($arr_list);
}

?>

</div> </td> </tr> </table>

<div id = "Add" style = "background-color : #ffffff; position : absolute; left : 400px; top : 200px; width : 400px; padding : 10px; border : thin solid black; word-wrap:break-word; visibility : hidden">

<form method = "get" action = "add_sch.php">

<input type = "hidden" name = "value" value = "<?php echo $_GET['value']; ?>">
<b> 일정 내용 <b> </p>
<textarea name = "content" rows = "8" cols = "47" style = "background-color : transparent; font-size : 15px; font-weight : bold; border : none;"></textarea> <br> <br>

<table style = "margin : 0 auto;"> <tr> <td>

<img src = "img/취소(일반).png" onclick = "document.getElementById('Add').style.visibility = 'hidden';" onmouseover = "this.src = 'img/취소(오버).png';" onmouseout = "this.src = 'img/취소(일반).png';" onmousedown = "this.src = 'img/취소(클릭).png';" onmouseup = "this.src = 'img/취소(오버).png';"> </td>

<td> </td> <td>

<input type = "image" src = "img/등록(일반).png" onmouseover = "this.src = 'img/등록(오버).png';" onmouseout = "this.src = 'img/등록(일반).png';" onmousedown = "this.src = 'img/등록(클릭).png';" onmouseup = "this.src = 'img/등록(오버).png';"> </td> </table>
</form> </div>

<div id = "Anni" style = "background-color : #ffffff; position : absolute; left : 400px; top : 200px; width : 400px; padding : 10px; border : thin solid black; word-wrap:break-word; visibility : hidden">

<form method = "get" action = "add_anni.php">

<b> 날짜 입력 : <b>
<?php

$string = "<select name = 'year'>";
for ($i = $date_now[0]-30; $i < $date_now[0]+100; $i++)
	$string .= "<option value = '$i'> $i </option>";
$string .= "</select>";

$string .= "<select name = 'mon'>";
for ($i = 1; $i <= 12; $i++)
	$string .= "<option value = '$i'> $i </option>";
$string .= "</select>";

$last_day = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);	//월에대한 일들
if (($date_now[0]%4 == 0 && $date_now%100) || $date_now%400 == 0) $last_day[1] = 29;

$string .= "<select name = 'day'>";
for ($i = 1; $i <= $last_day[$date_now[1]-1]; $i++)
	$string .= "<option value = '$i'> $i </option>";
$string .= "</select>";

echo $string;

?>
<input type = "hidden" name = "value" value = "<?php echo $_GET['value']; ?>">
</p> <b> 기념일 내용 <b> </p>
<textarea name = "content" rows = "8" cols = "47" style = "background-color : transparent; font-size : 15px; font-weight : bold; border : none;"></textarea> <br> <br>

<table style = "margin : 0 auto;"> <tr> <td>

<img src = "img/취소(일반).png" onclick = "document.getElementById('Anni').style.visibility = 'hidden';" onmouseover = "this.src = 'img/취소(오버).png';" onmouseout = "this.src = 'img/취소(일반).png';" onmousedown = "this.src = 'img/취소(클릭).png';" onmouseup = "this.src = 'img/취소(오버).png';"> </td>

<td> </td> <td>
<input type = "image" src = "img/등록(일반).png" onmouseover = "this.src = 'img/등록(오버).png';" onmouseout = "this.src = 'img/등록(일반).png';" onmousedown = "this.src = 'img/등록(클릭).png';" onmouseup = "this.src = 'img/등록(오버).png';"> </td> </table>
</form> </div>


<?php @mysql_close(); ?>
</body>
</html>
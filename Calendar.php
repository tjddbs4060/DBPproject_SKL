<?php require("connect_today.php"); session_start(); ?>

<!DOCTYPE>
<html>
<head> <meta charset="utf-8"> <title> ���� ���� ������ </title> </head>
<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>
<body style = "background-color : #f0f0f0; margin : 0 auto;">

<script type = "text/javascript" src = "Calendar.js"> </script>

<?php
//php������ html�� �ڹٽ�ũ��Ʈ�� ����Ͽ� �ڹٽ�ũ��Ʈó�� ���
$string = '<script type = "text/javascript">';

//�������� �߸� �ڵ����� ����Ǵ� �Լ�
$string .= 'window.onload = function() {';

//�޾ƿ� ���� Calendar.js ���Ͽ� �ִ� ���������� ����
$string .= "ymd = '".$_GET['value']."';";
$string .= "y_now = ".$_GET['Y'].";";
$string .= "m_now = ".$_GET['M'].";";

$string .= 'Calendar("Cal");';
$string .= '}';
$string .= '</script>';

echo $string;

//�ش��ϴ� id(���� ����)�� ���� id�� ��� ������� ���� ����
$query = "select * from anniversary where id is null or id = '".$_SESSION['userid']."' order by anni_mon, anni_day";
$result = mysql_query($query);

$string = "<script type = 'text/javascript'>";
$string .= "function anni_col() {";

//������ ������ anni��� ������ �迭�� ����
$string .= "var anni = new Array(";

//������ ������� ������ ���پ� ����Ͽ� �迭�� ������� ����
while ($list = mysql_fetch_assoc($result))
	$string .= $list['anni_mon'].", ".$list['anni_day'].",'".$list['content']."',";


//�迭�� �������� ,(�޸�)�� ����
$string = substr($string, 0, strlen($string)-1);
$string .= ");";
$string .= "return anni;";

$string .= "} </script>";

echo $string;

$last_day = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);	//�������� �ϵ�
if (($_GET['Y']%4 == 0 && $_GET['Y']%100) || $_GET['Y']%400 == 0) $last_day[1] = 29;

$string = "<script type = 'text/javascript'>";
$string .= "function sch_num_col() {";

$string .= "var sch_num = new Array(";

//�޷¿� ��µǾ� �ִ� ���� ���� �������� ��� ����
for ($i = 1; $i <= $last_day[$_GET['M']-1]; $i++) {
	$query = "select * from schedule where id = '".$_SESSION['userid']."' and sch_date = '".$_GET['Y']."-".$_GET['M']."-".$i."'";
	$result = mysql_query($query);
	$count = 0;

//���� ������ �ϳ��ϳ� Ȯ��
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
//���޵Ǿ��ִ� value ���� ������ ����
if ($_GET['value']) display_list($_GET['value']);

//���� ���� Ȯ���ϴ� �Լ�
function display_list($date_now) {
//�ش��ϴ� ���� id(�̱���)�� Ȯ���Ͽ� ���� ���
	$query = "select * from schedule where id = '".$_SESSION['userid']."' and sch_date = '$date_now' order by sch_start_time";	//���̵� �߰��Ǹ� where �ڿ� �߰��� ��
	$result = mysql_query($query);
	$i = 0;

	$div_string = "<h3 style = 'text-align : center; font-family : serif;'> <b>< ".$_GET['value']." ></b> </h3>";
//���� ���
	while ($arr_list = mysql_fetch_assoc($result)) {
		if (!$i) $div_string .= "<table class = 'sch' style = 'width : 300px;'>";
		if ($arr_list['friend_range']) $div_string .= "<tr> <td onclick = 'window.location.replace(\"check_sch.php?index=".$arr_list['sch_index']."\");' style = 'max-width : 270px; word-wrap : break-word;'> <font class = 'small'>".$arr_list['sch_start_time']." ~ ".$arr_list['sch_finish_time']." / ";
		else $div_string .= "<tr> <td style = 'max-width : 270px; word-wrap : break-word;'> <font class = 'small'>".$arr_list['sch_start_time']." ~ ".$arr_list['sch_finish_time']." / ";

		switch($arr_list['friend_range']) {
			case 0 : $div_string .= "��������"; break;
			case 1 : $div_string .= "ģ�����Ը�"; break;
			case 2 : $div_string .= "��ο���"; break;
			default : break;
		}

		$div_string .= "</font><br>".$arr_list['content']."</td> <td style = 'text-align : right; width : 30px;'>";
		$div_string .= "<img src = 'img/delete(default).png' onclick = 'window.location.replace(\"del_sch.php?value=".$_GET['value']."&index=".$arr_list['sch_index']."&Y=".$_GET['Y']."&M=".$_GET['M']."\");' onmouseover = 'this.src = \"img/delete(over).png\";' onmouseout = 'this.src = \"img/delete(default).png\";'>";
		$div_string .= "</td> <tr style = 'height : 10px'> </tr> </tr>";
		$i = 1;
	}
	if ($i) $div_string .= "</table>";

	$div_string .= "</td> </tr> <tr style = 'height : 20px'> </tr>";

//�ش��ϴ� ���� ������� Ȯ��
	$spl_date = explode("-", $date_now);
	$query = "select * from anniversary where (id = '".$_SESSION['userid']."' or id is null) and anni_mon = ".$spl_date[1]." and anni_day = ".$spl_date[2]." order by id";
	$result = mysql_query($query);

//������� �ִٸ� ���
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
	$div_string .= "<img src = 'img/sch(default).png' onclick = 'add_sch();' onmouseover = 'this.src = \"img/sch(over).png\";' onmouseout = 'this.src = \"img/sch(default).png\";'> </td>";	//���� �������� �Ѿ�� ��ư
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
<tr> <td> <div style = "width : 50px; text-align : center"> ���� �ð� </div> </td> <td style = "text-align : center;">

<?php

$string = "<select class = 'normal' name = 's_hour' style = 'background : none;'>";
for ($i = 0; $i < 24; $i++) {
	$string .= "<option class = 'normal' value = '$i'>";
	if ($i == 0) $string .= "AM 12 �� </option>";
	else if ($i/12 < 1) $string .= "AM $i �� </option>";
	else if ($i == 12) $string .= "PM $i �� </option>";
	else $string .= "PM ".($i%12)." �� </option>";
}
$string .= "</select>&nbsp&nbsp";

$string .= "<select class = 'normal' name = 's_minute' style = 'background : none;'>";
for ($i = 0; $i < 60; $i++)
	$string .= "<option class = 'normal' value = '$i'> $i �� </option>";
$string .= "</select>";

echo $string;

?>

</td> </tr>
<tr> <td> <div style = "width : 50px; text-align : center"> ���� �ð� </div> </td> <td style = "text-align : center;">

<?php

$string = "<select class = 'normal' name = 'f_hour' style = 'background : none;'>";
for ($i = 0; $i < 24; $i++) {
	$string .= "<option class = 'normal' value = '$i'>";
	if ($i == 0) $string .= "AM 12 �� </option>";
	else if ($i/12 < 1) $string .= "AM $i �� </option>";
	else if ($i == 12) $string .= "PM $i �� </option>";
	else $string .= "PM ".($i%12)." �� </option>";
}
$string .= "</select>&nbsp&nbsp";

$string .= "<select class = 'normal' name = 'f_minute' style = 'background : none;'>";
for ($i = 0; $i < 60; $i++)
	$string .= "<option class = 'normal' value = '$i'> $i �� </option>";
$string .= "</select>";

echo $string;

?>

</td> </tr>

<tr> <td> <div style = "width : 50px; text-align : center"> ���� ���� </div> </td> <td>
<textarea name = "content" rows = "6" cols = "43" style = "background-color : transparent; border : none;"></textarea>

</td> </tr> <tr class = 'normal'> <td> <div style = "width : 60px; text-align : center;"> ���� ���� ���� </div> </td> <td style = "text-align : center;">
<select name = "range" style = "background : none;">
<option value = "0"> ���� ���� </option>
<option value = "1"> ģ�����Ը� </option>
<option value = "2"> ��ο��� </option> </td></tr> </table>

<table style = "margin : 0 auto;"> <tr> <td>

<img src = "img/cancle(default).png" onclick = "document.getElementById('Add').style.visibility = 'hidden';" onmouseover = "this.src = 'img/cancle(over).png';" onmouseout = "this.src = 'img/cancle(default).png';"> </td>

<td> </td> <td>

<input type = "image" src = "img/add(default).png" onmouseover = "this.src = 'img/add(over).png';" onmouseout = "this.src = 'img/add(default).png';"> </td> </table>
</form> </div>

<div id = "Anni" style = "background-color : #ffffff; position : absolute; left : 400px; top : 300px; width : 400px; padding : 10px; border : thin solid black; word-wrap:break-word; visibility : hidden">
<table class = "normal" border = "1px">
<form method = "get" action = "add_anni.php">
<tr> <td> <div style = "width : 60px; text-align : center;"> ��¥<br>�Է� </div> </td> <td style = "text-align : center;">
<?php
//select�� ���(��/��/��)
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
<div style = "width : 60px; text-align : center;"> ����� ���� </div> </td> <td>
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
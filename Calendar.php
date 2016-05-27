<?php require("connect_today.php"); ?>

<!DOCTYPE>
<html>
<head> <title> 일정 관리 페이지 </title> </head>
<body>

<script type = "text/javascript" src = "Calendar.js"> </script>

<h1> 일정 관리 페이지 </h1>

<table> <tr> <td valign = "top">
<div id = "Cal" align = "left" style = "position : relative; width : 750px;"> </div> </td>

<td valign = "top"> <table> <tr> <td colspan = "2">
<div id = "View" align = "left" style = "position : relative; width : 300px; border : thin solid black; padding-left : 20px; padding-right : 20px; word-wrap:break-word;">

<h3 style = "text-align : center"> 일정 목록 </h3>

<?php

if ($_GET['value']) display_list($_GET['value']);

function display_list($date_now) {
	$query = "select content from schedule where sch_date = '$date_now'";	//아이디 추가되면 where 뒤에 추가할 것
	$result = mysql_query($query);
	$i = 0;

	$div_string = "<h3 style = 'text-align : center'> <b>- ".$_GET['value']." -</b> </h3>";

	while ($arr_list = mysql_fetch_assoc($result)) {
		if (!$i) $div_string .= "<form method = 'GET' action = 'del_sch.php'>";
		$div_string .= $arr_list['content']."<input type = 'checkbox' name = '$i' value = '".$arr_list['content']."' style = 'float : right;'> <br>";
		$i++;
	}

	$div_string .= "<br> </td> </tr> <tr> <td>";
	$div_string .= "<div onclick = 'add_sch();' style = \"background-image : url('test.png'); width : 100px; height : 50px; margin : 0 auto;\"> </div> </td>";	//수정 페이지로 넘어가는 버튼

	if ($i) $div_string .= "<td> <input type = 'submit' value = '선택 삭제'> </form> </td> </tr> </table>";
	else $div_string .= "<td> </td> </tr> </table>";

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

<table style = "margin : 0 auto;"> <th> <td>
<div style = "background-image : url('test.png'); width : 100px; height : 50px; margin : 0 auto;"> </div> </td>
<td> </td> <td>
<input type = "submit" value = "등록" align = "right" style = "font-size : 15px; font-weight : bold; float : right; width : 60px; height : 40px"> </td> </table>
</form> </div>

<?php @mysql_close(); ?>
</body>
</html>
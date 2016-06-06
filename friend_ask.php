<?php require("connect_today.php"); session_start(); ?>

<!DOCTYPE>
<html>
<head> <title> 친구창 </title> </head>
<body class = "body">
<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>

<?php
	$date = date("Y-m-d");
	$Y = date("Y");
	$M = date("m");
?>

<table width = "100%" class = "main"> <tr> <td>
	<div style = "text-align : left; margin-left : 20px;">
		<img src = "img/logo.png" width = "100px" height = "50px">
	</div> </td>
	<td align : right> <div style = "text-align : right; margin-right : 20px;">
		<img src = "img/home.png" width = "50px" height = "50px" onclick = "window.location.replace('main.php');">
		<img src = "img/friend_menu.png" width = "50px" height = "50px" onclick = "window.location.reload();">
		<img src = "img/sch_menu.png" width = "50px" height = "50px" onclick = <?php echo "\"window.location.replace('Calendar.php?value=$date&Y=$Y&M=$M');\""; ?> >
</div> </td> </tr> </table>

<table style = "width : 400px; height : 50px; margin : 0 auto; background-image : URL('img/friend_ask.png'); background-repeat : no-repeat;">
<tr style = "height : 46px; text-align : center;">
<td width = "28px"> </td>
<td onclick = "window.location.replace('friend_main.php');"> </td>
<td onclick = "window.location.replace('friend_accept.php');"> </td>
<td onclick = "window.location.reload();"> </td>
<td width = "28px"> </td>
</tr>

<tr>
<td colspan = "5" style = "background-color : #ffffff; height : 100px; padding : 20px;">

<form method = "GET" action = "ask_id.php">

<input type = "text" placeholder = "친구 신청 할 아이디를 입력해주세요." name = "friend" size = "40">

</form>

<table width = "350px" class = "normal">

<?php
//친구 신청
$query = "select * from friend where id = '".$_SESSION['userid']."' and accept = 'FALSE'";
$result = mysql_query($query);

while ($list = mysql_fetch_assoc($result))
	echo "<tr> <td>".$list['id_friend']."</td> <td style = 'text-align : right;'> <image src = 'img/cancle_friend(default).png' onclick = 'window.location.replace(\"ask_friend.php?id=".$list['id']."&id_friend=".$list['id_friend']."\");' onmouseover = 'this.src = \"img/cancle_friend(over).png\";' onmouseout = 'this.src = \"img/cancle_friend(default).png\";'> </td> </tr>";

?>

</table>

</td>
</tr>
</table>

<?php mysql_close(); ?>
</body>
</html>
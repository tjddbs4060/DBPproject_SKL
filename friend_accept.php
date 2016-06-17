<?php require("connect_today.php"); session_start(); ?>

<!DOCTYPE>
<html>
<head> <meta charset="utf-8"> <title> 친구창 </title> </head>
<body class = "body">
<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>

<?php
	$date = date("Y-m-d");
	$Y = date("Y");
	$M = date("m");
	if ($M < 10) $M = substr($M, 1, 1);
?>

<table width = "100%" class = "main"> <tr> <td>
	<div style = "text-align : left; margin-left : 20px;">
		<img src = "img/logo.png" width = "100px" height = "50px">
	</div> </td>
	<td align : right> <div style = "text-align : right; margin-right : 20px;">
		<img src = "img/home.png" width = "50px" height = "50px" onclick = "window.location.replace('main.php');">
		<img src = "img/friend_menu.png" width = "50px" height = "50px" onclick = "window.location.reload();">
		<img src = "img/sch_menu.png" width = "50px" height = "50px" onclick = <?php echo "\"window.location.replace('Calendar.php?value=$date&Y=$Y&M=$M');\""; ?> >
		<img src = "img/Logout(default).png" width = "50px" height = "50px" onclick = "window.location.replace('logout.php')" onmouseover = "this.src = 'img/Logout(over).png';" onmouseout = "this.src = 'img/Logout(default).png';">
</div> </td> </tr> </table>

<table style = "width : 400px; height : 50px; margin : 0 auto; background-image : URL('img/friend_accept.png'); background-repeat : no-repeat;">
<tr style = "height : 46px; text-align : center;">
<td width = "28px"> </td>
<td onclick = "window.location.replace('friend_main.php');"> </td>
<td onclick = "window.location.reload();"> </td>
<td onclick = "window.location.replace('friend_ask.php');"> </td>
<td width = "28px"> </td>
</tr>

<tr>
<td colspan = "5" style = "background-color : #ffffff; height : 100px; padding : 20px;">

<table width = "350px" class = "normal">

<?php
//받은거
$query = "select * from friend where id_friend = '".$_SESSION['userid']."' and accept = 'FALSE'";
$result = mysql_query($query);

while ($list = mysql_fetch_assoc($result))
	echo "<tr> <td>".$list['id']."</td> <td style = 'text-align : right;'> <image src = 'img/accept_friend(default).png' onclick = 'window.location.replace(\"accept_friend.php?id=".$list['id']."&id_friend=".$list['id_friend']."\");' onmouseover = 'this.src = \"img/accept_friend(over).png\";' onmouseout = 'this.src = \"img/accept_friend(default).png\";'> </td> </tr>";

?>

</table>

</td>
</tr>
</table>

<?php mysql_close(); ?>
</body>
</html>
<?php require("connect_today.php"); session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> 일정 확인 </title>
		<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>
		<script type="text/javascript">

		</script>
	</head>

	<?php
		$date = date("Y-m-d");
		$Y = date("Y");
		$M = date("m");
	?>

	<body class = "body">
	<table width = "100%" class = "main"> <tr> <td>
		<div style = "text-align : left; margin-left : 20px;">
			<img src = "img/logo.png" width = "100px" height = "50px">
		</div> </td>
		<td align : right> <div style = "text-align : right; margin-right : 20px;">
			<img src = "img/home.png" width = "50px" height = "50px" onclick="window.location.replace('main.php');">
			<img src = "img/friend_menu.png" width = "50px" height = "50px" onclick = "window.location.replace('friend_main.php')">
			<img src = "img/sch_menu.png" width = "50px" height = "50px" onclick = <?php echo "\"window.location.replace('Calendar.php?value=$date&Y=$Y&M=$M');\""; ?> >
			<img src = "img/Logout(default).png" width = "50px" height = "50px" onclick = "window.location.replace('logout.php')" onmouseover = "this.src = 'img/Logout(over).png';" onmouseout = "this.src = 'img/Logout(default).png';">
	</div> </td> </tr> </table>

		<form class = "normal" method='get' action=''>
			<fieldset style='background-color : #ffffff; width:500px; display: table; margin-left: auto; margin-right: auto;'>
		<?php
				$index = $_GET['index'];
				$query_AddDel = "select id from entry where sch_index = ".$index." and id ='".$_SESSION['userid']."'";
				$query_try = "select * from schedule where sch_index = ".$index;
				$result_try = mysql_query($query_try);
				$row = mysql_fetch_assoc($result_try);
				$string ="<legend>";
				$string .="<table>";
				$string .="<tr>";
				$string .="<td>";
				$string .="'".$row['id']."'";
				$string .="</td>";
				$string .="<td>";
				$string .="의 일정 확인";
				$string .= "</td></tr></table></legend>";
				$string .= "<div>";
				$string .= "&lt;" . $row['sch_date'] . "&gt";
				$string .= "</div>";
				$string .= "<div>";
				$string .= "<table style='width:100%;''>";
				$string .= "<tr>";
				$string .= "<td style='width:200px; text-align:center;''>";
				if($row['sch_start_time']=='00:00:00' && $row['sch_finish_time']=='00:00:00')  $string .= "";
				else $string .= $row['sch_start_time'] . " ~ " . $row['sch_finish_time'];
				$string .= "</td>";
				$string .= "<td>". $row['content'] ."</td></tr> <tr height = '15px'> </tr>";
				$string .= "<tr> <td style = 'text-align : center;'>";

				$query = "select * from support where sch_index = '$index'";
				$result = mysql_query($query);
				$num = mysql_num_rows($result);
				$string .= "<font color = '#0000ff'>";
				if (!$num) $string .= "응원한 사람이 없어요..";
				else $string .= "응원한 사람! <br>";
				$string .= "</font>";
				while ($arr_list = mysql_fetch_assoc($result)) {
					$string .= $arr_list['id']."<br>";
				}
				$string .= "</td> <td style = 'text-align : center;'>";

				$query = "select * from entry where sch_index = '$index'";
				$result = mysql_query($query);
				$num = mysql_num_rows($result);
				$string .= "<font color = '#0000ff'>";
				if (!$num) $string .= "같이하는 사람이 없어요..";
				else $string .= "같이하는 사람! <br>";
				$string .= "</font>";
				while ($arr_list = mysql_fetch_assoc($result)) {
					$string .= $arr_list['id']."<br>";
				}
				$string .= "</td> </tr> <tr height = '15px'> </tr> <tr> <td colspan = '2' style = 'text-align : center;'>";

				$query = "select * from comment where sch_index = '$index'";
				$result = mysql_query($query);
				$num = mysql_num_rows($result);
				$string .= "<font color = '#0000ff'>";
				if (!$num) $string .= "댓글 쓴 사람이 없어요.. </td> </tr>";
				else $string .= "댓글 쓴 사람! <br> </tr>";
				$string .= "</font>";
				while ($arr_list = mysql_fetch_assoc($result)) {
					$string .= "<tr> <td colspan = '2' style = 'text-align : center;'>".$arr_list['id']." | ".$arr_list['com_date']."<br>".$arr_list['content']."</p> </tr>";
				}

				$string .= "</table></div><br/>";
				$string .= "</fieldset></form><br/><br/>";

				echo $string;
		?>
	</body>
</html>
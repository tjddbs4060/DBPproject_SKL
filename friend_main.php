<?php require("connect_today.php"); session_start(); ?>

<!DOCTYPE>
<html>
<head> <title> ģ��â </title> </head>
<body>

ģ�� ��û ��� </p>

<?php

$query = "select * from friend where id = '".$_SESSION['userid']."' and accept = 'FALSE'";
$result = mysql_query($query);

while ($list = mysql_fetch_assoc($result))
	echo $list['id_friend']."<br>";

?>

ģ�� ��û ���� ��� </p>

<?php

$query = "select * from friend where id_friend = '".$_SESSION['userid']."' and accept = 'FALSE'";
$result = mysql_query($query);

while ($list = mysql_fetch_assoc($result))
	echo $list['id']."<br>";

?>

ģ�� ��� </p>

<?php

$query = "select * from friend where (id = '".$_SESSION['userid']."' or id_friend = '".$_SESSION['userid']."') and accept = 'TRUE'";
$result = mysql_query($query);

while ($list = mysql_fetch_assoc($result)) {
	if (!strcmp($list['id'], $_SESSION['userid'])) echo $list['id_friend']."<br>";
	else echo $list['id']."<br>";
}

?>

<?php mysql_close(); ?>
</body>
</html>
<?php

include "connect_today.php";

$query = "update friend set accept = 'TRUE' where id = '".$_GET['id']."' and id_friend = '".$_GET['id_friend']."'";
mysql_query($query);

@mysql_close();

echo "<script> alert('ģ���� �Ǿ����ϴ�.'); window.location.replace('friend_accept.php'); </script>";

?>
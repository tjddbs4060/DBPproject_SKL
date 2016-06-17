<?php

include "connect_today.php";

$query = "delete from friend where id = '".$_GET['id']."' and id_friend = '".$_GET['id_friend']."'";
mysql_query($query);

@mysql_close();

echo "<script> alert('친구가 삭제되엇습니다.'); window.location.replace('friend_main.php'); </script>";

?>
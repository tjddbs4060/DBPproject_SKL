<?php
//connect_today.php �ε�
include "connect_today.php";

//������ �������� ������ �������� �ʰ� �����ϸ� ����
if ($_GET['index']) del_ent();
else {
	@mysql_close();
	echo "<script> alert('������ �������ּ���.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function del_ent() {
//�޾ƿ� ���� �����̸� ���� ����
	$query = "delete from entry where join_index = '".$_GET['index']."'";	//id �߰��Ұ�
	mysql_query($query);

	@mysql_close();

	echo "<script> alert('������ �����Ǿ����ϴ�.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

?>
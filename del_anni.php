<?php
//connect_today.php �ε�
include "connect_today.php";

if ($_GET['index']) del_anni();
else {
	@mysql_close();
	echo "<script> alert('������� �������� �ʽ��ϴ�.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

function del_anni() {
//�ش� �ε��� ����� ����
	$query = "delete from anniversary where anni_index = ".$_GET['index'];	//id �߰��Ұ�
	mysql_query($query);

	@mysql_close();

	echo "<script> alert('������� �����Ǿ����ϴ�.'); window.location.replace('Calendar.php?value=".$_GET['value']."&Y=".$_GET['Y']."&M=".$_GET['M']."');</script>";
}

?>
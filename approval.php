<?php

SESSION_START();

include "conn.php";

//print_r ($_POST);

$check = implode(",",$_POST['check']);

$sql = "update user set approval = 1, approval_date = now() where no in ($check)";
$result = mysqli_query($conn,$sql);
if($result)
{
	echo "<script>alert('승인완료');
			location.href='/admin.php';
			</script>";
}
else
{
	echo "<script>alert('시스템 점검 필요');
			location.href='/admin.php';
			</script>";
}
?>
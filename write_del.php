﻿<?php

include "conn.php";
//print_r ($_POST);

 if(!isset($_POST['no']))
 {
	 echo "<script>
			alert('값을 찾을 수 없습니다.');
			 location.href='javascript:history.back()';
			</script>";
	 exit;
 }

$no = $_POST['no'];
//echo $no;
$sql = "delete from source_board where no = {$no}";
//echo $sql;
$result = mysqli_query($conn,$sql);

if($result)
{
	echo "<script>
		  alert ('게시물이 삭제 되었습니다.');
		  location.href='/main_board.html?no={$no}';
		  </script>";
}
else
{
	echo "<script>
		  alert ('잠시 후 다시 시도해주세요');
		   location.href='/main_board.html?no={$no}';
		  </script>";
		  
}
?>
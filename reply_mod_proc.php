<?php
SESSION_START();

include "conn.php";

$no = $_POST['no'];
$board_no = $_POST['board_no'];


$writer = mysqli_real_escape_string($conn,$_POST['writer']);
$content = mysqli_real_escape_string($conn,$_POST['content']);

if($_POST['writer'] == '' OR $_POST['content'] =='')
{
	echo "<script>
		  alert('내용이 입력되지 않았습니다.')
		  location.href='/write_read.php?no={$board_no}';
		  </script>";
	exit;
}

$sql = "update reply set writer = '{$writer}', content = '{$content}' where no = {$no}";
//echo $sql;
$result = mysqli_query($conn,$sql);
if($result)
	{
		echo  	    "<script>
					location.href='/write_read.php?no={$board_no}';
					</script>";
	}
else
	{
		echo 	"<script>
				 alert('다시 시도해주세요');
				 location.href='/write_read.php?no={$board_no}';
				</script>";
	}

?>

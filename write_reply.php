<?php
SESSION_START();

include "conn.php";

if(isset($_SESSION['ID']))
{
	$no = $_POST['no'];
	
	$writer = mysqli_real_escape_string($conn,$_SESSION['ID']);
	$content = mysqli_real_escape_string($conn,$_POST['content']);
}

if($writer == '' OR $_POST['content'] == '')
{
	echo "<script>
			alert('댓글 내용을 입력하세요')
			location.href='javascript:history.back()'
		 </script>";
	exit;
}

$sql = "INSERT INTO reply(writer, content, board_name, board_no) 
		Values('{$writer}','{$content}','free',{$no})"; 
		
$result = mysqli_query($conn,$sql);

if($result)
{
	$sql = "update source_board set reply = reply + 1 where no = {$no}";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
	echo	"<script>
	location.href='write_read.php?no={$no}';
	</script>";
}
else
{
	echo	"<script>
	alert('입력에 실패했습니다.');
	location.href='write_read.php?no={$no}';
	</script>";
}


?>
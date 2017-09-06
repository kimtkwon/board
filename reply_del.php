
<?php 

SESSION_START();

if(!isset($_SESSION['ID']))
{
	echo "<script>
		   location.href='javascript:history.back()';
		   </script>";
	exit;
}


 include "conn.php";
 if(!isset($_POST['no']) OR !isset($_POST['board_no']))
 {
	 echo "값을 찾을 수 없습니다.";
	 exit;
 }
	$no = $_POST['no'];
	$board_no = $_POST['board_no'];
//echo $no;
  $sql = "delete from reply where no = {$no} and board_name = 'free' and board_no = {$board_no}";
  $result = mysqli_query($conn,$sql);

  if($result) 
  {		
		$sql = "update source_board set reply = reply-1 where no = {$board_no}";
		$result = mysqli_query($conn, $sql);
		echo  "<script>
				location.href='/write_read.php?no={$board_no}';
				</script>";
  }
  else
  {
	  echo "<script>
			alert('댓글 삭제를 실패했습니다. ');
			</script>";
  }
  mysqli_close($conn);

?> 
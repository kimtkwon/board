
<?php 

SESSION_START();


 include "conn.php";
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
  mysqli_close($conn);

?> 
<?php
SESSION_START();

if(!isset($_SESSION['ID']))
{
	echo "<script>
		   location.href='javascript:history.back()';
		   </script>";
	exit;
}

?>
<html>
<head></head>
<body>
<style>
</style>

<?php
include "conn.php";

 if(!isset($_POST['no']) OR !isset($_POST['board_no']))
 {
	 echo "값을 찾을 수 없습니다.";
	 exit;
 }


$no = $_POST['no'];
$board_no = $_POST['board_no'];

$sql = "select * from reply where no = {$no} and board_no = {$board_no} and board_name = 'free'";
//echo $sql;
//exit;
$result = mysqli_query($conn,$sql);
$arr = mysqli_fetch_assoc($result);
?>

<form method="POST" action="reply_mod_proc.php">
	<input type="hidden" name="no" value="<?=$no?>">
	<input type="hidden" name="board_no" value="<?=$board_no?>">
<table border="1"> 
	<tr>
	<td align="center">작성자 :<input type="text" name="writer" value="<?=$arr['writer']?>"></td>
	</tr>
	<tr>
	<td align="center">수정 내용</td>
	</tr>
	<tr>
	<td><textarea cols="100" rows="10" name="content"><?=$arr['content']?></textarea></td>
	</tr>
	<tr>
	<td align="center"><input type="submit" value="수정하기"></td>
	</tr>
</form> 
</table>
</body>
</html>
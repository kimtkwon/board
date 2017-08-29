<?php
SESSION_START();

//print_r ($_POST);
//echo $no;
include "conn.php";


$no = $_POST['no'];
$writer = mysqli_real_escape_string($conn,$_POST['writer']);
$title = mysqli_real_escape_string($conn,$_POST['title']);
$content = mysqli_real_escape_string($conn,$_POST['content']);

if(!is_uploaded_file($_FILES['att']['tmp_name']))
{
	$sql = "update source_board set writer = '{$writer}', title = '{$title}', content = '{$content}' where no = {$no}";
//echo $sql;
	$result = mysqli_query($conn,$sql);
}
else
{
	$tmpfile = $_FILES['att']['tmp_name'];
	$updir = "c:\\xampp\\htdocs\\upload\\";
	$upfile =  $updir . $_FILES['att']['name'];
	$dbfile = "/upload/" . $_FILES['att']['name'];
	
		if(!move_uploaded_file($tmpfile, $upfile))
		{
			echo "<script>
			alert('파일 이동에 실패했습니다.');
			location.href='javascript:history.back()';
			</script>";
		}
	$sql = "update source_board set writer = '{$writer}', title = '{$title}', content = '{$content}', upload= '{$dbfile}' where no = {$no}";
	$result = mysqli_query($conn, $sql);
}
if($result)
{

	echo "<script>alert('{$_POST['no']}게시물이 수정 되었습니다.');
		  location.href='/write_read.php?no={$no}';
		  </script>";
}
else
{	
	
		echo "<script>alert('잠시 후 다시 시도하세요');
		  location.href='javascript:history.back()';
		  </script>";

}
?>
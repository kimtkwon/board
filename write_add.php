<?php
SESSION_START();
//print_r ($_POST['att']);

include "conn.php";

$writer = mysqli_real_escape_string($conn,$_POST['writer']);
$title = mysqli_real_escape_string($conn,$_POST['title']);
$content = mysqli_real_escape_string($conn,$_POST['content']);

if($writer == '' OR $title == '' OR $content == '' )
{
	echo "<script>alert('내용이 입력되지 않았습니다.');
		  location.href='/write_board.php';
		  </script>";
		exit;
}

  if(!is_uploaded_file($_FILES['att']['tmp_name']))
	{
	$sql = "INSERT INTO source_board(writer, title, content) 
          Values('{$writer}','{$title}', '{$content}')"; 
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
	
		$sql = "INSERT INTO source_board(writer, title, content, upload) 
          Values('{$writer}','{$title}', '{$content}','{$dbfile}')"; 
		  //echo $sql;
		$result = mysqli_query($conn,$sql);
	}

	if($result)
	{	
		mysqli_close($conn);
		echo "<script>alert('글이 등록되었습니다.');
				location.href='/main_board.html';
				</script>";
	}
	else
	{
		mysqli_close($conn);
		echo "<script>alert('서버 이상입니다.\n잠시 후 다시 시도해주세요');
			location.href='/main_board.html';
			</script>";
	}
?>


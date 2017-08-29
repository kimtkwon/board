<?php
	SESSION_START();

 include "conn.php";
 
  if($_POST['ID'] == '' OR $_POST['PASS'] == '')
  {
    echo "<script>
            alert('ID/PASS가 입력되지 않았습니다.');
            location.href='javascript:history.back()';
          </script>";
    exit;
  }

  $id = mysqli_real_escape_string($conn, $_POST['ID']);
  $pass = mysqli_real_escape_string($conn, $_POST['PASS']);

  $sql = "SELECT id,approval FROM user WHERE id = '{$id}' AND pass = sha2('{$pass}', 0)";

  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  $arr = mysqli_fetch_row($result);
  $approval = $arr[1];

if ($rows)
{ 
	if($approval == 1)
	{
		mysqli_free_result($result);
		$_SESSION['ID'] = $arr[0];
		$sql ="update user set last_login = now() where id = '{$arr[0]}'";
		$result = mysqli_query($conn,$sql);
		echo "<script>
            location.href='/main_board.html';
          </script>";
	}
	else
	{
		mysqli_free_result($result);
		echo "<script>
				alert('가입 승인 대기중입니다. tel:010-XXXX-XXXX');
				location.href='/login.php';
			</script>";
	}
}
else
{
	
	echo "<script>alert('아이디와 비밀번호를 입력하세요');
            location.href='/login.php';
          </script>";
}
  mysqli_close($conn);
?>
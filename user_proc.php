<?php

  if($_POST['ID'] == '' OR $_POST['PASS'] == '' OR $_POST['NAME'] == '')
  {
    echo "<script>
            alert('아이디,비밀번호,이름은 필수 입력사항 입니다.');
            location.href='javascript:history.back()';
          </script>";
    exit;
  }

  if($_POST['onoff'] == 0)
  {
	include "conn.php";

	$id = mysqli_real_escape_string($conn, $_POST['ID']);
	$pass = mysqli_real_escape_string($conn, $_POST['PASS']);
	$name = mysqli_real_escape_string($conn, $_POST['NAME']);
	$email = mysqli_real_escape_string($conn, $_POST['EMAIL']);
	$phone = mysqli_real_escape_string($conn, $_POST['PHONE']);

	$sql = "INSERT INTO user(id,pass,name,email,contact,join_date) VALUES('{$id}',sha2('{$pass}',0),'{$name}','{$email}','{$phone}',now())";
	$result = mysqli_query($conn,$sql);

	if($result)
	{
		 echo "<script>
              alert('가입 승인 요청되었습니다.');
              location.href='/login.php';
            </script>";
    }
    else
    {
      echo "<script>
              alert('가입에 실패 했습니다.');
              location.href='javascript:history.back()';
            </script>";
    }
  }
if($_POST['onoff'] == 1)
{
  echo "<script>
          alert('아이디 중복체크 하세요.');
          location.href='javascript:history.back()';
        </script>";
		exit;
}
	mysqli_close($conn);
?>
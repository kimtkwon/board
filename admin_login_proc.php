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

  $sql = "SELECT id FROM user WHERE id = '{$id}' AND pass = sha2('{$pass}', 0) AND admin =1";


  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  $arr = mysqli_fetch_row($result);

  mysqli_free_result($result);
  mysqli_close($conn);

  if($rows)
  {
    $_SESSION['ID'] = $arr[0];
    echo "<script>
            alert('관리자 모드로 로그인되었습니다');
            location.href='/admin.php';
          </script>";
  }
  else
  {
    echo "<script>
            alert('관리자에게 확인하세요');
            location.href='javascript:history.back()';
          </script>";
  }
?>

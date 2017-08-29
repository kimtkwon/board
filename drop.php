<?php
include "conn.php";

$id = $_POST['ask'];
$ids = "'".implode("','",$id)."'";


$sql = "DELETE FROM user WHERE id IN ($ids)";
$result = mysqli_query($conn,$sql);

if($result)
{
echo "<script>
     location.href='/admin.php';
  </script>";
}
else
{
  echo "<script>
      alert('서버이상, 재시도 필요');
      location.href='javascript:history.back()';
  </script>";
}
?>

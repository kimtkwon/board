<?php
include "conn.php";

if($_POST['ID'] == '')
{
  echo -1;
  exit;
}


$sql = "SELECT id FROM user WHERE id = '{$_POST['ID']}'";
$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);

if($rows)
{
  echo 1;
}
else
 {
   echo 0;
}
?>

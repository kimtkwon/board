<?php
SESSION_START();
?>
<form method="POST" action="">
<input type="submit" name="ask" value="조회" formaction="ask.php">
</form>

<?php
if(!isset($_SESSION['ID']))
{
  echo "접속오류";
  exit;
}
include "conn.php";
date_default_timezone_set("Asia/Seoul");

$diff_date = date("Y-m-d H:i:s", strtotime("-90 day"));

$sql = "SELECT no,id,name,last_login FROM user WHERE last_login <= '{$diff_date}'";

$result = mysqli_query($conn,$sql);
if(!$result)
{
  echo "테이블&필드명이 존재 하지않습니다";
  exit;
}
mysqli_close($conn);
$rows = mysqli_num_rows($result);
$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
echo "<table border='1'>";
echo "<tr>
  <th>선택</th><th width='40px'>번호</th><th width='150px'>아이디</th><th width='120px'>이름</th><th>최근 로그인기록</th>
</tr>";
if($rows)
{
  echo "$rows 건 확인됨";
  }
else
{
  echo "조회된 회원이 없습니다.";
}
for($i=0; $i<$rows; $i++)
	{
?>
<form method="POST">
	<tr>
		<td><input type="checkbox" name="ask[]" value="<?=$arr[$i]['id']?>"></td>
		<td style="text-align:center" width="40px"><?=$arr[$i]['no']?></td>
		<td style="text-align:center" width="150px"><b style="color:blue"><?=$arr[$i]['id']?></b></td>
		<td style="text-align:center" width="120px"><?=$arr[$i]['name']?></td>
    <td style="text-align:center" width="200px"><?=$arr[$i]['last_login']?></td>
	</tr>
<?php
	}
?>

	<tr height="50px">
		<td style="text-align:right" colspan="5"><input type="submit" value="탈퇴" formaction="drop.php"></td>
	</tr>
	</table>
</form>

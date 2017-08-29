<?php
SESSION_START();

if(!isset($_SESSION['ID']))
{
	echo "<script>location.href='/login.php';</script>";
}
?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>

<html>
<title>관리자페이지</title>
<form method="POST" action="logout.php">
<head><b id="head">관리자 모드</b><b id="head_sub">로 로그인중입니다</b>
<input type="submit" name="logout" value="logout">
<input type="button" onclick="location.href='/main_board.html'" value="board"></form>
</head>
<body>
<style>
	#head
	{
		font-size:14px;
		color:red;
	}
	#head_sub
	{
		font-size:14px;
	}
	.fieldset1
	{
		margin:50px auto;
		width:800px;
		height:500px;
		float:right;
	}

	.click
	{
		align:center;
		margin:20px auto;
	}
	table
	{
		background-color:#E6E6E6;
		font-family:"맑은 고딕";
		font-size:15px;
	}
	input
	{

	}
	.appr
	{
		border:1px solid gray;
		align:center;
	}
	legend
	{
		color:blue;
	}
	#space
	{
		padding:10px;
	}
</style>
<section>
<fieldset class="fieldset1">
<legend><b>통계/관리</b></legend>
	<center>
	<input type="hidden" name="analys" value=""><input type="button" class="click" name="analy1" value="회원현황">
	<input type="hidden" name="analys" value=""><input type="button" class="click" name="analy2" value="최근 등록글">
	<input type="hidden" name="analys" value=""><input type="button" class="click" name="analy3" value="인기글">
	<div id="test"></div>
	</center>
	<p height="50px">
</fieldset>
</section>
<aside width="300px">
<fieldset style="margin:50px auto">
<legend><b>가입 승인 대기 회원</b></legend>
<form method="POST" action="approval.php">
	<table class="appr">
	<tr>
		<th>선택</th><th width="40px">번호</th><th width="150px">아이디</th><th width="120px">이름</th><th>가입요청일</th>
	</tr>
<?php

	include "conn.php";

	$sql = "select no, id, name, join_date from user where approval = 0";
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);
	$fields = mysqli_num_fields($result);
	$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);


	for($i=0; $i<$rows; $i++)
	{
?>
	<tr>
		<td><input type="checkbox" name="check[]" value="<?=$arr[$i]['no']?>"></td>
		<td style="text-align:center" width="40px"><?=$arr[$i]['no']?></td>
		<td style="text-align:center" width="150px"><b style="color:red"><?=$arr[$i]['id']?></b></td>
		<td style="text-align:center" width="120px"><?=$arr[$i]['name']?></td>
		<td style="text-align:center" width="200px"><?=$arr[$i]['join_date']?></td>
	</tr>
<?php
	}
?>
	<tr height="50px">
		<td style="text-align:right" colspan="5"><input type="submit" value="승인"></td>
	</tr>
	</table>
</form>
<p id="space"></p>

<?php
mysqli_free_result($result);

date_default_timezone_set("Asia/Seoul");

$diff_date = date("Y-m-d H:i:s", strtotime("-90 day"));

$sql = "SELECT no,id,name,last_login FROM user WHERE last_login <= '{$diff_date}'";

$result = mysqli_query($conn,$sql);
mysqli_close($conn);
$rows = mysqli_num_rows($result);
$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
echo "<table class='appr'>";
echo "<tr>
  <th>선택</th><th width='40px'>번호</th><th width='150px'>아이디</th><th width='100px'>이름</th><th>최근 로그인</th>
</tr>";

if ($rows)
{
for($i=0; $i<$rows; $i++)
	{
?>
<form method="POST">
	<tr>
		<td><input type="checkbox" name="ask[]" value="<?=$arr[$i]['id']?>"></td>
		<td style="text-align:center" width="40px"><?=$arr[$i]['no']?></td>
		<td style="text-align:center" width="150px"><b style="color:blue"><?=$arr[$i]['id']?></b></td>
		<td style="text-align:center" width="100px"><?=$arr[$i]['name']?></td>
    <td style="text-align:center" width="200px"><?=$arr[$i]['last_login']?></td>
	</tr>
<?php
	}
}
?>
	<tr height="50px">
		<td style="text-align:right" colspan="5"><input type="submit" value="탈퇴" formaction="drop.php"></td>
	</tr>
</form>
</table>
</fieldset>
</aside>
<script>
	function analysis(data)
	{
		$("#test").html(data);
	}
	function ajax_analysis1()
	{
		$.ajax({
			type : "POST",
			url : "/analysis.php",
			data : {analys:1},
			success : analysis
		});
	}
	function ajax_analysis2()
	{
		$.ajax({
			type : "POST",
			url : "/analysis.php",
			data : {analys:2},
			success : analysis
		});
	}
	function ajax_analysis3()
	{
		$.ajax({
			type : "POST",
			url : "/analysis.php",
			data : {analys:3},
			success : analysis
		});
	}

	$("input[name='analy1']").click(ajax_analysis1);
	$("input[name='analy2']").click(ajax_analysis2);
	$("input[name='analy3']").click(ajax_analysis3);
</script>
</body>
</html>

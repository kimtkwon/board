<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
<?php
SESSION_START();
?>
<html>
<head>
<input type="button" value="글작성" onclick="location.href='/write_board.php'">&nbsp;&nbsp;
<input type="button" value="목록" onclick="location.href='/main_board.html'">
</head>
<body>
<style>

	header
	{
		font-size : 30px;
		text-align:center;
	}
	.go
	{
		text-align:right;
	}

	table
	{
		border-collapse:collapse;
		width:1000px;
		margin:20px auto;
		font-size:14px;
	}
	th
	{
		font-size:14px;
		padding:5px;
	}
	.title
	{
		background-color:#BDBDBD;
		color:white;
	}
	.tab,tr,td
	{
		border:1px solid #BDBDBD;
	}
	.reply
	{
		margin:10px auto;
		width:1100px;
		border:1px solid #BDBDBD;
	}
	.write_relpy
	{
		border:0px;
		text-align:left;
		margin:30px auto;
		color:gray;
	}
	.reply2
	{
		border:0px;
		resize:none;
	}
	#main
	{
		resize:none;
		wrap:hard;
		width:1100px;
		height:600px;
	}
	.file_change
	{
		font-size:12px;
	}
</style>
<?php

	
include "conn.php";
$no = $_GET['no'];
$sql = "select * from source_board where no = {$no}";
$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
$arr = mysqli_fetch_assoc($result);

//echo $no;
//print_r ($arr);
$sql = "update source_board set hit = hit + 1 where no = {$no}";
//echo $sql;
$result = mysqli_query($conn,$sql);

?>

<P>
<form method="POST" enctype="multipart/form-data" action="">
<input type="hidden" name="no" value="<?=$arr['no']?>">
<table class="tab" width="80%" align="center">
<tr>
</tr>
<?php
if ($_SESSION['ID'] == $arr['writer'])
{
?>
<tr>
<th class="title">제 목</th><td colspan="4"><input type="text" name="title" value="<?=$arr['title']?>"></td>
</tr>
<?php
}
else
{
?>
<tr>
<th class="title">제 목</th><td colspan="4"><?=$arr['title']?></td>
</tr>
<?php
}
?>
<tr>
<th width="200px">작성자</th><td><input type="hidden" name="writer" value="<?=$arr['writer']?>"><?=$arr['writer']?><th width="100px">조회수</th><td><?=$arr['hit']?></td>
</tr>
<tr>
<th>작성일</th><td colspan="4"><?=$arr['date']?></td>
</tr>
<tr>
<th>첨부파일</th>
<?php
if ($_SESSION['ID'] == $arr['writer'])
{
	if($arr['upload'] != "")
	{
?>
<td colspan="4">&nbsp;&nbsp;<a href="http://127.0.0.1/<?=$arr['upload']?>" download="<?=$arr['upload']?>"><img src="/diskket.png" width="17px" height="17px"></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="file_change" type="button" name="change" value="첨부파일 변경"><div id="change"></div></td>
</tr>
<?php
	}
	else
	{
?>
		<td colspan="4"><input class="file_change" type="button" name="change" value="첨부파일 변경"><div id="change"></div></td></tr>
<?php
	}
}
else
{ 
	if($arr['upload'] != "")
	{
?>
<td colspan="4">&nbsp;&nbsp;<a href="http://127.0.0.1/<?=$arr['upload']?>" download="<?=$arr['upload']?>"><img src="/diskket.png" width="17px" height="17px"></a>
</td>
</tr>
<?php
	}
	else
	{
?>
		<td colspan="4"></td></tr>
<?php
	}
}
?>
<tr height="20px">
</tr>
<tr>
	<td colspan="4"><center><b>SOURCE</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>
	<input type="button" name="small" value="작게"><input type="button" name="middle" value="중간"><input type="button" name="big" value="크게"></td>
</tr>
<?php
 if ($_SESSION['ID'] == $arr['writer'] or $_SESSION['ID'] =='kimtkwon' or $_SESSION['ID'] == 'skeh158')
 {
?>
<tr>
<td colspan="4"><textarea id="main" cols="160" rows="50" name="content"><?=$arr['content']?></textarea></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="목록" onclick="location.href='/main_board.html'">
<input type="submit" value="수정" formaction="write_mod.php">
<input type="submit" value="삭제" formaction="write_del.php">
<?php
 }
 else
 {
?>
<tr>
<td colspan="4"><textarea id="main" cols="160" rows="50" name="content" readonly><?=$arr['content']?></textarea></td>
</tr>
<tr>
<td colspan="4" align="center">
<input type="button" value="목록" onclick="location.href='/main_board.html'">
<?php
 }
?>
</td>
</tr>
<tr>
</tr>
<tr>
<td class="go" colspan="4">
<input type="button" value="W3SCHOOL" onclick="window.open('https://www.w3schools.com/')">
<input type="button" value="웹에서 연습하기" onclick="window.open('https://codebeautify.org/htmlviewer')">
</td>
</tr>
</form>
</table>
<table class="write_relpy">
 <form method="POST" action="write_reply.php">
	<tr class="write_relpy">
	<td class="write_relpy"><input type='hidden' name='no' value='<?=$no?>'></td>
	<td class="write_relpy"><b><?=$_SESSION['ID']?></b></td>
	<td class="write_relpy"><textarea cols="120" rows="2" name="content" ></textarea></td>
	<td style="border:0"><input type="submit" value="댓글등록"></td>
	</tr>
 </form> 
 </table>
<fieldset class="reply">
 <legend>댓글</legend>
<?php
$sql = "select writer,content,date,no from reply where board_name = 'free' and board_no = {$no}";

$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
$arr = mysqli_fetch_all($result,MYSQLI_ASSOC);


if(isset($rows))
{
	for($i=0; $i<$rows; $i++)
		
	{ 
?>
<table class="write_relpy">
<form method="POST" >
	<tr class="write_relpy">
	<td class="write_relpy"><input type='hidden' name='no' value='<?=$arr[$i]['no']?>'>
	<input type='hidden' name='board_no' value='<?=$no?>'><?=$arr[$i]['writer']?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$arr[$i]['date']?></td>
	</tr>
	<tr class="write_relpy">
	<td class="write_relpy"><textarea class="reply2"cols="120" rows="2" name="content" ><?=$arr[$i]['content']?></textarea></td>
<?php
	if($_SESSION['ID'] == $arr[$i]['writer'] or $_SESSION['ID'] =='kimtkwon' or $_SESSION['ID'] == 'skeh158')
	{
?>
	<td class="write_relpy" align="center"><input type="submit"  value="삭제" formaction="reply_del.php">
	<input type="submit" value="수정" formaction="reply_mod.php"></td>
<?php
	}
?>
	</tr>
</form>
</table> 

<?php
	}
}

mysqli_free_result($result);
$sql = "insert into recent (board_no,lastview) values('{$no}', now())";
$result = mysqli_query($conn,$sql);
mysqli_close($conn);
?>
</fieldset>
<script>
	function small()
	{
		$("#main").css({"font-size":"14px"});
	}
	function middle()
	{
		$("#main").css({"font-size":"16px"});
	}
	function big()
	{
		$("#main").css({"font-size":"20px"});
	}
	$("#main").css({"font-size":"16px"});
	$("input[name='small']").click(small);
	$("input[name='middle']").click(middle);
	$("input[name='big']").click(big);
	
	function file_change()
	{
		$("#change").html("<input type='file' name='att' value='파일선택'>");
		$("img").hide();
		$("input[name='change']").hide();
	}
	$("input[name='change']").click(file_change);
</script>
</body>
</html>


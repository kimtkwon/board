<?php
SESSION_START();
?>
<html>
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
	.th
	{
		font-family:"맑은 고딕";
		font-size:14px;
		width:100px;
	}
	.table1
	{
		float:left;
		margin : 10px ;
	}
	.move
	{
		background-color:#5858FA;
		color:white;
		height:30px;
	}
	.recent
	{
		border:1px solid gray;
		margin-top:10px;
		width:100%;
		font-size:13px;
		padding:3px;
		border-collapse:collapse;
	}
	.recent2
	{
		border:1px solid gray;
		cursor:hand;
	}
	aside
	{
		text-align:center;
		border:1px solid #D8F6CE;
		float:left;
		width:18%;
		margin:20px auto;
		height:100%;
	}
	section
	{
		float:right;
		width:80%
	}
</style>
 <aside>
 <b style="font-size:14px; background-color:gray; color:white">나의 글 목록</b>
<table class="recent">
<tr class="recent2">
	<th class="recent2">No</th><th width="60px" class="recent2">제목</th>
</tr>
<?php
	include "conn.php";
	
	if(isset($_SESSION['ID']))
	{
		$sql = "select no, title from source_board where writer = '{$_SESSION['ID']}'";
		$result = mysqli_query($conn,$sql);
		$rows = mysqli_num_rows($result);
		
		if($result)
		{
			$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			for($i=0; $i<$rows; $i++)
			{
				echo "<tr onclick=\"location.href='/write_read.php?no={$arr[$i]['no']}'\">";
				echo "<td class='recent2'>{$arr[$i]['no']}</td><td class='recent2'>{$arr[$i]['title']}</td>";
				echo "</tr>";
			}
			
		}
	}
	mysqli_free_result($result);
?>
</table>
<p>
<b style="font-size:14px; background-color:gray; color:white">최근 본 글</b>
<table class="recent">
<tr class="recent2">
	<th class="recent2">No</th><th width="60px" class="recent2">제목</th>
</tr>
<?php
	$sql = "select source_board.no, source_board.title, source_board.writer, recent.lastview from source_board, recent 
			where source_board.no = recent.board_no order by lastview desc limit 5;";
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);
	if($result)
		{
			$arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
			for($i=0; $i<$rows; $i++)
			{
				echo "<tr onclick=\"location.href='/write_read.php?no={$arr[$i]['no']}'\">";
				echo "<td class='recent2'>{$arr[$i]['no']}</td><td class='recent2'>{$arr[$i]['title']}</td>";
				echo "</tr>";
			}
			
		}
	mysqli_close($conn);
?>
</table>
</aside>
<body>
<section>
<P>
<form method="POST" enctype="multipart/form-data" action="">
<table class="table1" border="0" >
<tr>
<th class="th">작성자</th><td><input type="text" name="writer" value="<?=$_SESSION['ID']?>" readonly></td><td></td>
</tr>
<tr>
<th class="th">제목</th><td colspan="2"><textarea name="title" cols="60" rows="1" autofocus></textarea></td>
</tr>
<tr>
<th class="th">첨부파일</th><td><input type="file" name="att"></td><td></td>
</tr>
</table>
<table class="table1" border="1" >
<tr>
<th colspan="2">SOURCE</th>
</tr>
<tr>
<td colspan="2"><textarea cols="150" rows="50" name="content"  style="resize:none"></textarea></th>
</tr>
<tr>
<td colspan="2" align="center">
<input style="cursor:hand" type="submit" value="목록으로" formaction="main_board.html" name="board">
<input style="cursor:hand" type="submit" value="등록하기" formaction="write_add.php" name="add">
</td>
</tr>
<tr>
<td class="go" colspan="2">
<input class="move" type="button" value="W3SCHOOL" onClick="window.open('https://www.w3schools.com')">
<input class="move" type="button" value="웹에서 연습하기" onClick="window.open('https://codebeautify.org/htmlviewer')">
</td>
</tr>
</form>
</table> 
 </section>

</body>

</html>
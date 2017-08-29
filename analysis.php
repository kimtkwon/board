<?php

SESSION_START();

include "conn.php";

$analys = $_POST['analys'];


if($analys == 1 )
{
$sql = "select no,id,name,approval_date,email from user";

$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
$arr = mysqli_fetch_all($result,MYSQLI_ASSOC);

echo "<table border ='1'><tr>";
echo "<th>회원번호</th><th>ID</th><th>이름</th><th>가입일</th><th>이메일</th></tr>";
	for($i=0; $i<$rows; $i++)
	{
		echo "<tr>";
		echo "<td>{$arr[$i]['no']}</td>
			  <td>{$arr[$i]['id']}</td>
			  <td>{$arr[$i]['name']}</td>
			  <td>{$arr[$i]['approval_date']}</td>
			  <td  align='center'><a href='mailto:{$arr[$i]['email']}'><img src='email2.png' width='20px' height='20px'></a></td>";		  
		echo "</tr>"
			 ;
	}
echo "</table>";
}


if($analys == 2 )
{
$sql = "select no, title, writer, date from source_board order by date desc limit 5;";
$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
$fields = mysqli_num_fields($result);
$arr = mysqli_fetch_all($result,MYSQLI_NUM);

echo "<table border ='1'><tr>";
echo "<th>최근글번호</th><th>제목</th><th>작성자</th><th>등록일</th></tr>";
	for($i=0; $i<$rows; $i++)
	{
			  echo "<tr>";
		for($j=0; $j<$fields; $j++)
		{
			echo "<td>{$arr[$i][$j]}</td>";
		}
		echo "</tr>"
			 ;
	}
echo "</table>";
}





if($analys == 3 )
{
$sql = "select no,title, writer, date, hit from source_board order by hit desc limit 3";

$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
$fields = mysqli_num_fields($result);
$arr = mysqli_fetch_all($result,MYSQLI_NUM);

echo "<table border ='1'><tr>";
echo "<th>글번호</th><th>제목</th><th>작성자</th><th>작성일</th><th>조회수</th></tr>";
	for($i=0; $i<$rows; $i++)
	{
			  echo "<tr>";
		for($j=0; $j<$fields; $j++)
		{
			echo "<td>{$arr[$i][$j]}</td>";
		}
		echo "</tr>"
			 ;
	}
echo "</table>";
}
?>
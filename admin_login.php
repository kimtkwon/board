
<html>
<head>
  <style>
    table 
	{
	  border:1px solid gray;
      text-align: center;
	  margin:130px auto;
	  background-color:#E0F8F1;
	  padding:20px;
	  
    }  
	.login
	{
		height:50px;
	}
	.join
	{
		width:100px;
		cursor:hand;
	}
	td,tr
	{
		padding:1px;
	}
	.admin
	{	
		font-size:15px;
		color:red;
	}
  </style>
</head>
<body>
	<center><b class="admin">관리자 전용</b></center>
    <div class="login">
      <table  align="center">
        <form method="POST" action="admin_login_proc.php">
		<tr>
		</tr>
        <tr>
			<td><input type="text" name="ID" placeholder="아이디 입력" autofocus></td>
			<td class="login" rowspan="2"><input style="height:50px; cursor:hand" type="submit" value="로그인"></td>
		</tr>
        <tr>
			<td><input type="text" name="PASS" placeholder="비밀번호 입력"></td>
		</tr>
        <tr height="40px">
			<td colspan="2">
			<input class="get" type="button" value ="일반 회원" onclick="location.href='/login.php'"></td>
		</tr>
        </form>
      </table>
    </div>
</body>
</html>
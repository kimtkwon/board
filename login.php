
<?php
SESSION_START();
?>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>

<head>
  <style>
    #login_box
	{
	  border:1px solid gray;
      text-align: center;
	  margin:150px auto;
	  background-color:#E0F8F1;
	  padding:30px;
	  
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
		padding:2px;
	}
	img
	{
		position:relative;
	}
</style>
</head>
<body>
      <table  id="login_box" align="center" width="20%" height="50%">
        <form method="POST" action="login_proc.php">
		<tr></tr>
        <tr>
			<td><input type="text" name="ID" placeholder="아이디 입력" autofocus></td>
			<td class="login" rowspan="2"><input style="height:50px; cursor:hand; color:white; background-color:#58ACFA" type="submit" value="로그인"></td>
		</tr>
        <tr>
			<td><input type="text" name="PASS" placeholder="비밀번호 입력"></td>
		</tr>
		<tr>
		</tr>
        <tr height="40px">
			<td colspan="3"><input class="join" type="button" onclick="location.href='/user.html'" value="회원가입">
			<input class="get" type="button" value ="관리자" onclick="location.href='/admin_login.php'"></td>
		</tr>
        </form>
      </table>

<center><img src="/moniter.jpg" name="monitor" width="30%" height="20%" style="margin:150px 0 0 0"></center>
<img src="/keyboard.jpg" name="keyboard" width="20%" height="3%" align="left" style="margin-left:40%">
<img src="/mouse.jpg" name="mouse" width="6%" height="6%" align="right" style="margin-right:25%">

   
<script>
	function login()
	{
		$("#login_box").show();
		$("img[name='monitor']").hide();
		$("img[name='mouse']").hide();
	}
	function login_hide()
	{
		$("#login_box").hide();
		$("img[name='monitor']").show();
		$("img[name='mouse']").show();
	}
	$("#login_box").hide();
	$("img[name='monitor']").show();
	$("img[name='mouse']").show();
	$("img[name='mouse']").click(login);
	$("img[name='keyboard']").click(login_hide);

</script>
</body>
</html>
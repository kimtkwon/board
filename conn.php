<?php
	$conn = mysqli_connect("127.0.0.1", "root", "0208", "source");
	
	if (!isset($conn))
	{
		echo "서버 접속에 실패하였습니다";
	}
?>
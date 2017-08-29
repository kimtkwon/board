<?php
	include "conn.php";
	
	$field = $_POST['field'];
	$search = $_POST['search'];
	
	if ($search =='')
	{
		echo "<script>;location.href='/main_board.html';</script>";
	}
	
?>
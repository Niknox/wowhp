<?php
	session_start();
	if (!isset($_SESSION['username']))
	{
		header('Location: https://www.xserv.net/login.php');
		exit;
	}
?>
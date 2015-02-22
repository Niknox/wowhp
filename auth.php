<?php
	session_start();
	if (!isset($_SESSION['username']))
	{
		header('Location: http://wow.xserv.net/login.php');
		exit;
	}
?>
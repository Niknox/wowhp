<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	header('refresh:3;https://www.xserv.net/index.php');
?>
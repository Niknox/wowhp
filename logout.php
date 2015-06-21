<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	header('refresh:3;http://wow.xserv.net/index.php');
?>
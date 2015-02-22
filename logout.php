<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	header('Location: http://wow,xserv.net/index.html');
?>
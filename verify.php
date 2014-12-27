<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="xserv, wow, xserv wow, world of warcraft, blizzlike, privatserver, 3.3.5a, wotlk">
	<meta name="description" content="Xserv ist ein kostenoser WoW Blizzlike-Server mit kompetentem Team und freundlicher Community">
	<meta name="author" content="Nikno">
	<title>Xserv WoW: Accountverifizierung</title>
	<link rel="icon" href="images/favicon.gif" type="image/x-icon">
	<link rel="stylesheet" href="main.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<img id="logo" src="images/logo.png" alt="Xserv WoW Blizzlike">
	</header>
	<nav>
		<ul>
			<li><a class="navbar" href="index.html">Startseite</a></li>
			<li><a class="navbar" href="forum/index.php/BoardList/">Forum</a></li>
			<li><a class="navbar" href="regeln.html">Regeln</a></li>
			<li><a class="navbar" href="faq.html">FAQ</a></li>
			<li><a class="navbar" href="account.php">Account</a></li>
			<li><a class="navbar" href="ts.html">Teamspeak</a></li>
		</ul>
	</nav>
	<hr class="main">
	<h3>Accountaktivierung</h3>
	<?php
	require_once 'mysql.php';
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$email = test_input($_GET['email']);
	$key = test_input($_GET['key']);
	$emailIns = mysqli_real_escape_string($connect, $email);
	$keyIns = mysqli_real_escape_string($connect, $key);

	if (isset($email) && isset($key))
	{
		$query1 = "UPDATE `activation` SET isactive='yes' WHERE mail='$emailIns' AND hash='$keyIns'";
		$query2 = "UPDATE `account` SET locked='0' WHERE email='$emailIns'";
		if(!mysqli_query($connect, $query1))
		{
			die('Error: ' . mysqli_error($connect) . ' Fehlercode: 23');
		}
		if(!mysqli_query($connect, $query2))
		{
			die('Error: ' . mysqli_error($connect) . ' Fehlercode: 22');
		}
		if (mysqli_affected_rows($connect) == 1)
		{
			echo 'Dein Account wurde erfolgreich aktiviert.';
		}
		else
		{
			echo 'Fehler bei der Erstellung deines Accounts. Fehlercode: 20';
		}
	}
	else
	{
		echo 'Fehler bei der Erstellung deines Accounts. Fehlercode: 21';
	mysqli_close($connect);
	?>
</body>
</html>
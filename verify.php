<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="xserv, wow, xserv wow, world of warcraft, blizzlike, privatserver, 3.3.5a, wotlk">
	<meta name="description" content="Xserv ist ein kostenoser WoW Blizzlike-Server mit kompetentem Team und freundlicher Community">
	<meta name="author" content="Nikno">
	<title>Xserv WoW: Passwort vergessen</title>
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
	<?php
	require_once 'mysql.php';
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($connect, $data);
		return $data;
	}
	$email = test_input($_GET['email']);
	$key = test_input($_GET['key']);
	$query = "SELECT * FROM activate WHERE email ='$email' and isactive = 1";
	$result = mysqli_query($connect,$query);

	if (isset($email) && isset($key))
	{
		mysqli_query($connect, "UPDATE `activation`, `account` SET activation.isactive=yes, account.locked='0' WHERE activation.email='$email' AND activation.hash='$key' AND account.email='$email' ") or die(mysqli_error());
		if (mysqli_affected_rows($connect) == 1)
		{
			echo '<div>Dein Account wurde erfolgreich aktiviert.</div>';
			
		}
		else
		{
			echo '<div>Account konnte nicht aktiviert werden.</div>';
		}
	}
	mysqli_close($connect);
	?>
</body>
</html>
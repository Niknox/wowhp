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
	<article>
	<div class="center"><h2>Accountaktivierung</h2></div>
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
		$query2 = "UPDATE `account`, `activation` SET account.locked='0' WHERE account.email='$emailIns' AND activation.hash='$keyIns'";
		if (!mysqli_query($connect, $query1))
		{
			die($error='Error: ' . mysqli_error($connect) . ' Fehlercode: 23');
		}
		if (!mysqli_query($connect, $query2))
		{
			die($error='Error: ' . mysqli_error($connect) . ' Fehlercode: 22');
		}
		if (mysqli_affected_rows($connect) == 1)
		{
			$success='Dein Account wurde erfolgreich aktiviert.<br><br><a href="index.html">Zurück zur Startseite</a>';
		}
		else
		{
			$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 20";
		}
	}
	else
	{
		$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 21";
	}
	mysqli_close($connect);
	?>
	<br /><span class="error"><?php echo $error?></span><span class="success"><?php echo $success;?></span>
	</article>
	<hr class="main">
	<footer>
		&copy; 2014 Xserv - All rights reserved.
		<a id="imp" href="impressum.html">Impressum</a>
		<a href="http://jigsaw.w3.org/css-validator/validator?uri=wow.xserv.net&amp;profile=css3&amp;usermedium=all&amp;warning=1&amp;vextwarning="><img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS is valid!"> </a>
		<a href="http://validator.w3.org/check?uri=http%3A%2F%2Fwow.xserv.net%2F"><img style="border:0;width:88px;height:31px" src="http://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png" alt="HTML5 is valid!"> </a>
	</footer>
</body>
</html>
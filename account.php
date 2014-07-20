<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="xserv, wow, xserv wow, world of warcraft, blizzlike, privatserver, 3.3.5a, wotlk">
	<meta name="description" content="Xserv ist ein kostenoser WoW Blizzlike-Server mit kompetentem Team und freundlicher Community">
	<meta name="author" content="Nikno">
	<title>Xserv WoW: Accounterstellung</title>
	<link rel="icon" href="favicon.gif" type="image/x-icon">
	<link rel="stylesheet" href="main.css">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<img id="logo" src="logo.png" alt="Xserv WoW Blizzlike">
	</header>
	<nav>
		<ul>
			<li><a class="navbar" href="index.html">Startseite</a></li>
			<li><a class="navbar" href="regeln.html">Regeln</a></li>
			<li><a class="navbar" href="faq.html">FAQ</a></li>
			<li><a class="navbar" href="account.php">Account</a></li>
			<li><a class="navbar" href="ts.html">Teamspeak</a></li>
		</ul>
	</nav>
	<hr class="main">
	<article>
	<h3>Hier kannst du einen Account erstellen:</h3>
		<form action="process.php" method="post">
			<label for="name">Accountname:</label><input type="text" name="name"><span class="error"><?php echo $nameErr;?></span><br />
			<label for="pw">Passwort:</label><input type="password" name="pw"><span class="error"><?php echo $pwErr;?></span><br />
			<label for="pw2">Passwort bestätigen:</label><input type="password" name="pw2"><span class="error"><?php echo $pwErr;?></span><br />
			<label for="email">E-Mail-Adresse:</label><input type="email" name="email"><span class="error"><?php echo $emailErr;?></span><br />
			<input type="submit" name="submit" value="Submit" class="button">
		</form>
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
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
	<article>
	<h3>Hier kannst du dein Passwort zurücksetzen:</h3>
		<?php
		require_once 'mysql.php';
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<label for="name">Accountname:</label><input type="text" name="name"><span style="font-size:75%;margin-left:50px;">Du hast deinen Accountnamen vergessen? Kontaktiere bitte einen Administrator.</span><br />
			<label for="email">E-Mail-Adresse:</label><input type="email" name="email"><br />
			<input type="submit" name="submit" value="Submit" class="button">
			<?php
			$name = test_input($_POST["name"]);
			$email = test_input($_POST["email"]);
			if (!mysqli_connect_errno()) //MySQL Verbindung testen
			{
				if ($_SERVER["REQUEST_METHOD"] == "POST") //Formularverbindung testen
				{
					if (!empty($name))
					{
						if (!empty($email))
						{
							$nameIns=mysqli_real_escape_string($connect, $name);
							$emailIns=mysqli_real_escape_string($connect, $email);
							$query = "SELECT * FROM `account` WHERE `username` = '$nameIns' AND `email` = '$emailIns'";
							mysqli_query($connect,$query);
							$rows = mysqli_affected_rows($connect);
							if ($rows == 1)
							{
								$success = "Daten validiert. Es wurde eine Bestätigungsmail an dich gesendet. Bitte klicke auf den Link um dein Passwort zurückzusetzen.";
								$created = date("Y-m-d H:i:s");
								$hash = md5(uniqid(rand(), true));
								
								$query="UPDATE `activation` SET hash2 = '$hash', created2 = '$created' WHERE mail='$emailIns'";
								mysqli_query($connect,$query);
								
								$url='http://wow.xserv.net/verifypw.php?email=' . urlencode($emailIns) . "&key=$hash";
								mail($email, "Passwort bei Xserv WoW zuruecksetzen", "Hallo $name,\n\num dein Passwort zurueckzusetzen, klicke bitte auf den nachfolgenden Link:\n\n$url \n\nViel Spass auf Xserv WoW!");
								mysqli_close($connect);
							}
							else
							{
								$error="Accountname und Mail-Adresse stimmen nicht überein.";
							}
						}
						else
						{
							$error="Bitte gib eine E-Mail-Adresse ein.";
						}
					}
					else
					{
						$error="Bitte gib einen Accountnamen ein.";
					}
				}
			}
			else
			{
				$error="Fehler beim Aufbau der Datenbankverbindung. Sollte dieser Fehler erneut auftreten, kontaktieren Sie bitte einen Administrator. Fehlercode: 10";
			}
			?>
			<br /><span class="error"><?php echo $error?></span><span class="success"><?php echo $success;?></span>
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
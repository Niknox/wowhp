<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="xserv, wow, xserv wow, world of warcraft, blizzlike, privatserver, 3.3.5a, wotlk">
	<meta name="description" content="Xserv ist ein kostenoser WoW Blizzlike-Server mit kompetentem Team und freundlicher Community">
	<meta name="author" content="Nikno">
	<title>Xserv WoW: Passwort zurücksetzen</title>
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
	<div class="center"><h2>Passwort zurücksetzen</h2></div>
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
		<form action="verifypw.php?email=<?php echo $_GET['email'];?>&key=<?php echo $_GET['key'];?>" method="post">
		<label for="pw">Neues Passwort:</label><input type="password" name="pw"><br />
		<label for="pw2">Passwort bestätigen:</label><input type="password" name="pw2"><br />
		<input type="submit" name="submit" value="Submit" class="button">
		<?php
		$email = test_input($_GET['email']);
		$key = test_input($_GET['key']);
		$pwIns = mysqli_real_escape_string($connect, $pw);
		$emailIns = mysqli_real_escape_string($connect, $email);
		$keyIns = mysqli_real_escape_string($connect, $key);
		if ($_SERVER["REQUEST_METHOD"] == "POST") //Formularverbindung testen
		{
			$pw = test_input($_POST['pw']);
			$pw2 = test_input($_POST['pw2']);
			if (!empty($emailIns) && !empty($keyIns))
			{
				if (!empty($pw))
				{
					if (!empty($pw2))
					{
						if ($pw == $pw2)
						{
							if (preg_match("/^(?=.*[A-Za-z])[a-zA-Z0-9!?*+-.,]{6,20}$/",$pw))
							{
								$query = "SELECT * FROM `activation` WHERE `mail` = '$emailIns' AND `hash2` = '$keyIns'";
								mysqli_query($connect,$query);
								$rows = mysqli_affected_rows($connect);
								if ($rows == 1)
								{
									$nameIns = strtoupper($nameIns); //In Grossbuchstaben umwandeln
									$hash = SHA1(strtoupper($nameIns.':'.$pwIns)); //Passworthash erstellen
									$query="UPDATE `account` SET sha_pass_hash='$hash' WHERE email='$emailIns'";
									$query2="UPDATE `activation` SET hash2 = '' WHERE mail = '$emailIns'";
									if (!mysqli_query($connect,$query))
									{
										die($error = 'Error: ' . mysqli_error($connect) . ' Fehlercode: 32');
									}
									if (!mysqli_query($connect,$query2))
									{
										die($error = 'Error: ' . mysqli_error($connect) . ' Fehlercode: 31');
									}
									else
									{
										$success = "Passwort erfolgreich geändert.";
									}
								}
								else
								{
									$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 30";
								}
							}
							else
							{
								$error="Das Passwort ist zu kurz (mind. 6 Stellen), zu lang (max. 20 Stellen), oder enthält nicht erlaubte Zeichen. Erlaubt sind: A-Z, a-z, 0-9, !?*+-.,";
							}
						}
						else
						{
							$error="Die Passwörter stimmen nicht überein.";
						}
					}
					else
					{
						$error="Bitte gib dein Passwort zur Bestätigung ein.";
					}
				}
				else
				{
					$error="Bitte gib ein Passwort ein.";
				}
			}
			else
			{
				$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 33";
			}
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
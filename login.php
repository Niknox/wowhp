<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="xserv, wow, xserv wow, world of warcraft, blizzlike, privatserver, 3.3.5a, wotlk">
	<meta name="description" content="Xserv ist ein kostenoser WoW Blizzlike-Server mit kompetentem Team und freundlicher Community">
	<meta name="author" content="Nikno">
	<title>Xserv WoW: Login</title>
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
	<h3>Accountlogin:</h3>
		<?php
		$name = $pw = "";
		$success = $error = "";
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
			<label for="name">Accountname:</label><input type="text" name="name" id="name"><br />
			<label for="pw">Passwort:</label><input type="password" name="pw" id="pw"><span style="font-size:75%;margin-left:50px;">Passwort vergessen? <a href="forgotpw.php">Hier klicken!</a></span><br />
			<input type="submit" name="submit" value="Submit" class="button">
			<?php
			$name = test_input($_POST["name"]);
			$pw = test_input($_POST["pw"]);
			if (!mysqli_connect_errno()) //MySQL Verbindung testen
			{
				if ($_SERVER["REQUEST_METHOD"] == "POST") //Formularverbindung testen
				{
					session_start(); 
					if (!empty($name)) //Feld Accountname nicht leer
					{
						$nameIns=mysqli_real_escape_string($connect, $name);
						$nameAvail = "SELECT * FROM `account` WHERE `username` = '$nameIns'";
						mysqli_query($connect,$nameAvail);
						$rows = mysqli_affected_rows($connect);
						if ($rows == 1) //Accountname stimmt
						{
							if (!empty($pw)) //Feld Passwort nicht leer
							{
								$pwIns=mysqli_real_escape_string($connect, $pw);
								$nameIns = strtoupper($nameIns); //In Grossbuchstaben umwandeln
								$hash = SHA1(strtoupper($nameIns.':'.$pwIns)); //Passworthash erstellen
								$query="SELECT * FROM `account` WHERE `username` = '$nameIns' AND `locked` = '0'";
								mysqli_query($connect,$query);
								$rows = mysqli_affected_rows($connect);
								if ($rows == 1) //Accountname stimmt und nicht gesperrt
								{
									$abfrage = "SELECT username, sha_pass_hash FROM account WHERE username LIKE '$nameIns' LIMIT 1";
									$result = mysqli_query($connect,$abfrage); 
									$row = mysqli_fetch_object($result); 
									if($row->sha_pass_hash == $hash) 
									{ 
										$_SESSION["username"] = $nameIns; 
										$success = 'Login erfolgreich. <a href="profile.php">Weiter zu ihrem Account.</a>';
										mysqli_free_result($result);
									}
									else
									{
										$error = "Login fehlgeschlagen. Falsches Passwort.";
									}
								}
								else
								{
									$error = "Der Account ist leider gesperrt oder noch nicht aktiviert.";
								}
							}
							else
							{
								$error = "Bitte gib ein Passwort ein.";
							}
						}
						else
						{
							$error = "Dieser Accountname existiert nicht.";
						}
					}
					else
					{
						$error = "Bitte gib einen Accountnamen ein.";
					}
				}
			}
			else
			{
				$error = "Fehler beim Aufbau der Datenbankverbindung. Sollte dieser Fehler erneut auftreten, kontaktieren Sie bitte einen Administrator. Fehlercode: 10";
			}
			?>
			<br /><span class="error"><?php echo $error;?></span><span class="success"><?php echo $success;?></span>
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
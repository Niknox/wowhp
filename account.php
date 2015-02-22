<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="xserv, wow, xserv wow, world of warcraft, blizzlike, privatserver, 3.3.5a, wotlk">
	<meta name="description" content="Xserv ist ein kostenoser WoW Blizzlike-Server mit kompetentem Team und freundlicher Community">
	<meta name="author" content="Nikno">
	<title>Xserv WoW: Accounterstellung</title>
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
	<h3>Hier kannst du einen Account erstellen:</h3>
		<?php
		$name = $pw = $pw2 = $email = "";
		$nameErr = $pwErr = $emailErr = $success = $error = "";
		$nameIns = $pwIns = $emailIns = "";
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
			<label for="pw2">Passwort bestätigen:</label><input type="password" name="pw2" id="pw2"><br />
			<label for="email">E-Mail-Adresse:</label><input type="email" name="email" id="email"><br />
			<input type="submit" name="submit" value="Submit" class="button">
			<?php
			$name = test_input($_POST["name"]);
			$pw = test_input($_POST["pw"]);
			$pw2 = test_input($_POST["pw2"]);
			$email = test_input($_POST["email"]);
			if (!mysqli_connect_errno()) //MySQL Verbindung testen
			{
				if ($_SERVER["REQUEST_METHOD"] == "POST") //Formularverbindung testen
				{
					if (!empty($name)) //Feld Accountname nicht leer
					{
						if (preg_match("/^[a-zA-Z0-9]{3,20}$/",$name)) //Verifiziere Accountname
						{
							$nameIns=mysqli_real_escape_string($connect, $name);
							$nameAvail = "SELECT * FROM `account` WHERE `username` = '$nameIns'";
							mysqli_query($connect,$nameAvail);
							$rows = mysqli_affected_rows($connect);
							if ($rows == 0) //Accountname noch nicht vorhanden
							{
								if (!empty($pw)) //Feld Passwort nicht leer
								{
									if (!empty($pw2)) //Feld Passwort bestätigen nicht leer
									{
										if ($pw == $pw2) //Passwörter stimmen überein
										{
											if (preg_match("/^(?=.*[A-Za-z])[a-zA-Z0-9!?*+-.,]{6,20}$/",$pw)) //Verifiziere Passwort (mind. 6 Zeichen, mind. ein Buchstabe)
											{
												if (!empty($email)) //Feld Email nicht leer
												{
													$pwIns=mysqli_real_escape_string($connect, $pw);
													$emailIns=mysqli_real_escape_string($connect, $email);
													$nameIns = strtoupper($nameIns); //In Grossbuchstaben umwandeln
													$hash = SHA1(strtoupper($nameIns.':'.$pwIns)); //Passworthash erstellen
													$query="INSERT INTO `account` (username, sha_pass_hash, email, last_ip, locked, expansion, os) VALUES ('$nameIns', '$hash', '$emailIns', '127.0.0.1', '1', '2', 'Win')";
													if (!mysqli_query($connect,$query))
													{
														die($error = 'Error: ' . mysqli_error($connect) . ' Fehlercode: 15');
													}
													else
													{
														$success = "Daten validiert. Es wurde eine Aktivierungsmail an dich gesendet. Bitte klicke auf den Link um die Accounterstellung abzuschließen.";
														$created = date("Y-m-d H:i:s");
														$hash = md5(uniqid(rand(), true));
														
														$query="INSERT INTO `activation` (hash, created, mail, isactive) VALUES ('$hash', '$created', '$emailIns', 'no')";
														mysqli_query($connect,$query);
														
														$url='http://wow.xserv.net/verify.php?email=' . urlencode($emailIns) . "&key=$hash";
														$subject = "Registrierung bei Xserv WoW abschließen";
														$headers   = array();
														$headers[] = "MIME-Version: 1.0";
														$headers[] = "Content-type: text/plain; charset=utf-8";
														$headers[] = "From: Xserv WoW <admin@xserv.net>";
														$headers[] = "Reply-To: Xserv WoW <admin@xserv.net>";
														$headers[] = "Subject: {$subject}";
														$headers[] = "X-Mailer: PHP/".phpversion();
														$mailtext = "Hallo $name,\n\num die Registrierung abzuschließen, klicke bitte auf den nachfolgenden Link:\n\n$url \n\nViel Spaß auf Xserv WoW!";

														mail($email, $subject, $mailtext, implode("\r\n", $headers));
														mysqli_close($connect);
													}
												}
												else
												{
													$emailErr = "Bitte gib eine E-Mail-Adresse ein.";
												}
											}
											else
											{
												$pwErr = "Das Passwort ist zu kurz (mind. 6 Stellen), zu lang (max. 20 Stellen), oder enthält nicht erlaubte Zeichen. Erlaubt sind: A-Z, a-z, 0-9, !?*+-.,";
											}
										}
										else
										{
											$pwErr = "Die Passwörter stimmen nicht überein.";
										}
									}
									else
									{
										$pwErr = "Bitte gib dein Passwort zur Bestätigung ein.";
									}
								}
								else
								{
									$pwErr = "Bitte gib ein Passwort ein.";
								}
							}
							else
							{
								$nameErr = "Der Accountname ist leider bereits vorhanden.";
							}
						}
						else
						{
							$nameErr = "Der Accountname ist zu kurz (mind. 3 Stellen), zu lang (max. 20 Stellen), oder enthält nicht erlaubte Zeichen. Erlaubt sind: Kleinbuchstaben, Großbuchstaben, Zahlen.";
						}
					}
					else
					{
						$nameErr = "Bitte gib einen Accountnamen ein.";
					}
				}
			}
			else
			{
				$error = "Fehler beim Aufbau der Datenbankverbindung. Sollte dieser Fehler erneut auftreten, kontaktieren Sie bitte einen Administrator. Fehlercode: 10";
			}
			?>
			<br /><span class="error"><?php echo $nameErr;echo $pwErr;echo $emailErr;echo $error;?></span><span class="success"><?php echo $success;?></span>
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
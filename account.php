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
			<li><a class="navbar" href="forum/index.php">Forum</a></li>
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
		$nameErr = $pwErr = $emailErr = $success = "";
		$name_insert = $pw_insert = $email_insert = "";
		$name_available = "";
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
			<label for="name">Accountname:</label><input type="text" name="name"><span class="error"><?php echo $nameErr;?></span><br />
			<label for="pw">Passwort:</label><input type="password" name="pw"><span class="error"><?php echo $pwErr;?></span><br />
			<label for="pw2">Passwort bestätigen:</label><input type="password" name="pw2"><span class="error"><?php echo $pwErr;?></span><br />
			<label for="email">E-Mail-Adresse:</label><input type="email" name="email"><span class="error"><?php echo $emailErr;?></span><br />
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
											$name_insert = mysqli_real_escape_string($connect, $name);
											$nametest = "SELECT * FROM `account` WHERE `username` = '$name_insert'";
											mysqli_query($connect,$nametest);
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
																					$pw_insert = mysqli_real_escape_string($connect, $pw);
																					if (!empty($email)) //Feld Email nicht leer
																						{
																							$email_insert = mysqli_real_escape_string($connect, $email);
																							$name_insert = strtoupper($name_insert);
																							$hash = SHA1(strtoupper($name_insert.':'.$pw_insert)); //Passworthash erstellen
																							$query="INSERT INTO `account` (username, sha_pass_hash, email, expansion, os) VALUES ('$name_insert', '$hash', '$email_insert', '2', 'Win')";
																							if (!mysqli_query($connect,$query))
																								{
																									die('Error: ' . mysqli_error($connect));
																								}
																							else
																								{
																									$success = "Account erfolgreich erstellt.";
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
					else
						{
							//$success = "Generischer Fehler in der Datenübertragung. Sollte dieser Fehler erneut auftreten, kontaktieren Sie bitte einen Administrator. Fehlercode: 11";
						}
				}
			else
				{
					$success = "Fehler beim Aufbau der Datenbankverbindung. Sollte dieser Fehler erneut auftreten, kontaktieren Sie bitte einen Administrator. Fehlercode: 10";
				}
			?>
			<br /><?php echo $nameErr;echo $pwErr;echo $emailErr;echo $success;?>
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

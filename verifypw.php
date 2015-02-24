<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: Passwort zurücksetzen</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
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
		<form action="verifypw.php?email=<?php echo $_GET['email'];?>&amp;key=<?php echo $_GET['key'];?>" method="post">
		<label for="pw">Neues Passwort:</label><input type="password" name="pw" id="pw"><br />
		<label for="pw2">Passwort bestätigen:</label><input type="password" name="pw2" id="pw2"><br />
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
										die($error = 'Error: ' . mysqli_error($connect) . ' Fehlercode: 45');
									}
									else if (!mysqli_query($connect,$query2))
									{
										die($error = 'Error: ' . mysqli_error($connect) . ' Fehlercode: 46');
									}
									else
									{
										$success = "Passwort erfolgreich geändert.";
									}
								}
								else
								{
									$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 42";
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
				$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 41";
			}
		}
		?>
		<br /><span class="error"><?php echo $error;?></span><span class="success"><?php echo $success;?></span>
		</form>
	</article>
	<hr class="main">
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>
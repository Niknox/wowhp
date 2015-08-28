<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: Passwort vergessen</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
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
			<label for="name">Accountname:</label><input type="text" name="name" id="name"><span style="font-size:75%;margin-left:50px;">Du hast deinen Accountnamen vergessen? Kontaktiere bitte einen Administrator.</span><br />
			<label for="email">E-Mail-Adresse:</label><input type="email" name="email" id="email"><br />
			<input type="submit" name="submit" value="Submit" class="button">
			<?php
			$error = $success = "";
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
							$nameIns = mysqli_real_escape_string($connect, $name);
							$emailIns = mysqli_real_escape_string($connect, $email);
							$query = "SELECT * FROM `account` WHERE `username` = '$nameIns' AND `email` = '$emailIns'";
							mysqli_query($connect,$query);
							$rows = mysqli_affected_rows($connect);
							if ($rows == 1)
							{
								$success = "Daten validiert. Es wurde eine Bestätigungsmail an dich gesendet. Bitte klicke auf den Link um dein Passwort zurückzusetzen.";
								$created = date("Y-m-d H:i:s");
								$hash = md5(uniqid(rand(), true));
								
								$query = "UPDATE `activation` SET hash2 = '$hash', created2 = '$created' WHERE mail='$emailIns'";
								mysqli_query($connect,$query);
								
								$url = 'https://www.xserv.net/verifypw.php?email=' . urlencode($emailIns) . "&key=$hash";
								$subject = "Xserv WoW Passwort zurücksetzen";
								$headers   = array();
								$headers[] = "MIME-Version: 1.0";
								$headers[] = "Content-type: text/plain; charset=utf-8";
								$headers[] = "From: Xserv WoW <admin@xserv.net>";
								$headers[] = "Reply-To: Xserv WoW <admin@xserv.net>";
								$headers[] = "Subject: {$subject}";
								$headers[] = "X-Mailer: PHP/".phpversion();
								$mailtext = "Hallo $name,\n\num dein Passwort zurückzusetzen, klicke bitte auf den nachfolgenden Link:\n\n$url \n\nSollte es irgendwelche Probleme geben, kontaktiere einen Administrator.\n\nViel Spaß auf Xserv WoW!";

								mail($email, $subject, $mailtext, implode("\r\n", $headers));
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
				$error="Fehler beim Aufbau der Datenbankverbindung. Sollte dieser Fehler erneut auftreten, kontaktieren Sie bitte einen Administrator. Fehlercode: 30";
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
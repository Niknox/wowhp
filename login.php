<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: Login</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
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
										$success = 'Login erfolgreich. Sie werden in 3 Sekunden weitergeleitet.';
										mysqli_free_result($result);
										
										header('refresh:3;http://wow.xserv.net/profile.php');
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
	<?php include('footer.php');?>
	</footer>
</body>
</html>
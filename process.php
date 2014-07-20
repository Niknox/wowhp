<?php
$name = $pw = $pw2 = $email = "";
$nameErr = $pwErr = $emailErr = "";
$name_insert = $pw_insert = $email_insert = "";

$connect=mysqli_connect("localhost","trinity","","auth");

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty($_POST["name"]))
			{
				$nameErr = "Bitte gib einen Accountnamen ein.";
			}
		else
			{
				$name = test_input($_POST["name"]);
				if (!preg_match("/^[a-zA-Z0-9]*$/",$name))
					{
						$nameErr = "Dein Accountname enthält nicht erlaubte Zeichen. Erlaubt sind: Kleinbuchstaben, Großbuchstaben, Zahlen.";
					}
				else
					{
						$name_insert = mysqli_real_escape_string($connect, $name);
					}
			}
		if (empty($_POST["pw"]))
			{
				$pwErr = "Bitte gib ein Passwort ein.";
			}	
		else if (($_POST["pw"]) != ($_POST["pw2"]))
			{
				$pwErr = "Die Passwörter stimmen nicht überein.";
			}
		else
			{
				$pw = test_input($_POST["pw"]);
				if(!preg_match("/^(?=.*[A-Za-z])[a-zA-Z0-9!?$%&*+-.,]{6,20}$/",$pw))
					{
						$pwErr = "Das Passwort enthält nicht erlaubte Zeichen. Erlaubt sind: A-Z, a-z, 0-9, !?$%&*+-.,";
					}
				else
					{
						$pw_insert = mysqli_real_escape_string($connect, $pw);
					}
		if (empty($_POST["pw2"]))
			{
				$pwErr = "Bitte gib ein Passwort ein.";
			}
		else
			{
				$pw2 = test_input($_POST["pw2"]);
			}
		if (empty($_POST["email"]))
			{
				$emailErr = "Bitte gib eine E-Mail-Adresse ein.";
			}
		else
			{
				$email = test_input($_POST["email"]);
				$email_insert = mysqli_real_escape_string($connect, $email);
			}
	}
function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

if (mysqli_connect_errno())
	{
		echo "Fehler bei der Accounterstellung: " . mysqli_connect_error();
	}
$hash = SHA1(strtoupper($name_insert.':'.$pw_insert));
$sql="INSERT INTO `account` (username, sha_pass_hash, email, expansion, os)
VALUES ('$name_insert', '$hash', '$email_insert', '2', 'Win')";

if (!mysqli_query($connect,$sql))
	{
		die('Error: ' . mysqli_error($connect));
	}
mysqli_close($connect);
?>
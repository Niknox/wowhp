<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: Accountverifizierung</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
	<hr class="main">
	<article>
	<div class="center"><h2>Accountaktivierung</h2></div>
	<?php
	require_once 'mysql.php';
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$email = test_input($_GET['email']);
	$key = test_input($_GET['key']);
	$emailIns = mysqli_real_escape_string($connect, $email);
	$keyIns = mysqli_real_escape_string($connect, $key);

	if (isset($email) && isset($key))
	{
		$query1 = "UPDATE `activation` SET isactive='yes' WHERE mail='$emailIns' AND hash='$keyIns'";
		$query2 = "UPDATE `account`, `activation` SET account.locked='0' WHERE account.email='$emailIns' AND activation.hash='$keyIns'";
		if (!mysqli_query($connect, $query1))
		{
			die($error='Error: ' . mysqli_error($connect) . ' Fehlercode: 25');
		}
		if (!mysqli_query($connect, $query2))
		{
			die($error='Error: ' . mysqli_error($connect) . ' Fehlercode: 26');
		}
		if (mysqli_affected_rows($connect) == 1)
		{
			$success='Dein Account wurde erfolgreich aktiviert.<br><br><a href="index.html">Zurück zur Startseite</a>';
		}
		else
		{
			$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 24";
		}
	}
	else
	{
		$error="Fehler bei der Erstellung deines Accounts. Fehlercode: 21";
	}
	mysqli_close($connect);
	?>
	<br /><span class="error"><?php echo $error;?></span><span class="success"><?php echo $success;?></span>
	</article>
	<hr class="main">
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>
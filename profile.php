<?php include('auth.php'); ?>
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
		<a id="imp" href="logout.php">Ausloggen</a>
		<?php $accountname = $_SESSION["username"];?>
		Spenden insgesamt: PHP...
		Jetzt spenden PHP...
		Spendenpunkte ausgeben PHP...
	</article>
	<hr class="main">
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>
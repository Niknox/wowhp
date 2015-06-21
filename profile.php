<?php include('auth.php'); ?>
<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: Profil</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
	<hr class="main">
	<article>
		<?php
			require_once 'mysql.php';
			$username = $_SESSION["username"];
			$row = array();
			$query = "SELECT `donated`, `points` FROM `donation` WHERE `username`='$username'";
			if ($result = mysqli_query($connect,$query))
			{
				$row = mysqli_fetch_assoc($result);
			}
		?>
		<h3>Spendenübersicht</h3>
		Insgesamt gespendet: <?php printf ($row["donated"] + '€');?><br />
		Spendenpunkte gesamt: <?php printf ($row["points"] + ' Punkte')?><br />
		<a href="donate.php">Jetzt spenden</a><br />
		<a href="points.php">Spendenpunkte ausgeben</a>
		<?php mysqli_free_result($result); mysqli_close($connect);?>
	</article>
	<hr class="main">
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>
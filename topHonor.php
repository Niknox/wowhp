<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="xserv, wow, xserv wow, world of warcraft, blizzlike, privatserver, 3.3.5a, wotlk">
	<meta name="description" content="Xserv ist ein kostenoser WoW Blizzlike-Server mit kompetentem Team und freundlicher Community">
	<meta name="author" content="Nikno">
	<title>Top-Liste: Ehre</title>
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
			<li><a class="navbar" href="forum/index.php">Forum</a></li>
			<li><a class="navbar" href="regeln.html">Regeln</a></li>
			<li><a class="navbar" href="faq.html">FAQ</a></li>
			<li><a class="navbar" href="account.php">Account</a></li>
			<li><a class="navbar" href="ts.html">Teamspeak</a></li>
		</ul>
	</nav>
	<hr class="main">
	<article>
		<div class="center"><h3>Spieler Top 10: Ehrenpunkte</h3></div>
		<table>
			<tr>
				<th>Platz</th>
				<th>Spieler</th>
				<th>Level</th>
				<th>Kills gesamt</th>
				<th>Ehre gesamt</th>
				<th>Kills heute</th>
				<th>Ehre heute</th>
				<th>Kills gestern</th>
				<th>Ehre gestern</th>
			</tr>
			<?php
			require_once 'mysql.php';
			$i="0";
			if (mysqli_connect_errno())
			{
				echo "Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			$query="SELECT * FROM `characters` ORDER BY `totalKills` DESC LIMIT 0,10";
			if ($result = mysqli_query($connect2,$query))
			{
				while($rows = mysqli_fetch_object($result))
				{
					$spieler = $rows->name;
					$level = $rows->level;
					$kills_gesamt = $rows->totalKills;
					$ehre_gesamt = $rows->totalHonorPoints;
					$kills_heute = $rows->todayKills;
					$ehre_heute = $rows->todayHonorPoints;
					$kills_gestern = $rows->yesterdayKills;
					$ehre_gestern = $rows->yesterdayHonorPoints;
					$i++;
					echo "
					<tr>
					<td>",$i,"</td>
					<td>",$spieler,"</td>
					<td>",$level,"</td>
					<td>",$kills_gesamt,"</td>
					<td>",$ehre_gesamt,"</td>
					<td>",$kills_heute,"</td>
					<td>",$ehre_heute,"</td>
					<td>",$kills_gestern,"</td>
					<td>",$ehre_gestern,"</td>
					</tr>";
					mysqli_free_result($result);
				}
			}
			?>
		</table>
	</article>
</body>
</html>
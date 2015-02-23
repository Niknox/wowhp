<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: Top-Liste/Ehre</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
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
				echo "Connect failed: %s\n", mysqli_connect_error();
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
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>
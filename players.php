<?php
try {
	$conn = new PDO('mysql:host=localhost;dbname=characters;charset=utf8', 'root', '');
	$query_fetch_players = 'SELECT count(*) FROM characters WHERE online = 1';
	$result = $conn->prepare($query_fetch_players);
	$result->execute();
	$playerCount = $result->fetchColumn();

	$query_fetch_players_alliance = 'SELECT count(*) FROM characters WHERE online = 1 AND (race = 1 OR race = 3 OR race = 4 OR race = 7 OR race = 11)';
	$result = $conn->prepare($query_fetch_players_alliance);
	$result->execute();
	$playerAllianceCount = $result->fetchColumn();

	$query_fetch_players_horde = 'SELECT count(*) FROM characters WHERE online = 1 AND (race = 2 OR race = 5 OR race = 6 OR race = 8 OR race = 10)';
	$result = $conn->prepare($query_fetch_players_horde);
	$result->execute();
	$playerHordeCount = $result->fetchColumn();
	
	$conn = new PDO('mysql:host=localhost;dbname=auth;charset=utf8', 'root', '');
	$query_uptime = 'SELECT uptime FROM uptime WHERE starttime=(SELECT MAX(starttime) FROM uptime)';
	$result = $conn->prepare($query_uptime);
	$result->execute();
	$uptime = $result->fetchColumn();
	$hours = intval(intval($uptime) / 3600); 
	$minutes = intval(($uptime / 60) % 60);
	$seconds = intval($uptime % 60);
	$uptime = $hours . "h " . $minutes . "m " . $seconds . "s";
}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
<header>
	<img id="logo" src="images/logo.png" alt="Xserv WoW Blizzlike">
	<fieldset class="playerCount">
	<legend>Status</legend>
	<?php require_once 'players.php'; ?>
	Spieler online: <?php echo $playerCount; ?><br />
	Allianz: <?php echo $playerAllianceCount; ?><br />
	Horde: <?php echo $playerHordeCount; ?><br />
	Status: <span style="color:#00CC00;font-weight:bold">Online</span> (<?php echo $uptime; ?>)
	</fieldset>
</header>
<nav>
	<ul>
		<li><a class="navbar" href="index.php">Startseite</a></li>
		<li><a class="navbar" href="forum/index.php/BoardList/">Forum</a></li>
		<li><a class="navbar" href="regeln.php">Regeln</a></li>
		<li><a class="navbar" href="faq.php">FAQ</a></li>
		<li><a class="navbar" href="account.php">Account</a></li>
		<li><a class="navbar" href="ts.php">Teamspeak</a></li>
	</ul>
</nav>
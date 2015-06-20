<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: FAQ</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
	<hr class="main">
	<article>
		<div class="list">
			<h3>Ich habe ein Problem mit Xserv und komme nicht weiter, wo finde ich Hilfe?</h3>
				Es gibt viele Möglichkeiten um Support auf Xserv zu erhalten, du kannst: 
				<ul>
					<li>im Teamspeak (IP: xserv.net) in den WoW-Support-Channel gehen, ein Teammitglied wird sich um dich kümmern.</li>
					<li>im Spiel ein Ticket eröffnen; dazu unten in der Menüleiste auf das rote Fragezeichen und dann auf "Ticket erstellen" klicken.</li>
					<li>im Forum ein neues Thema unter "Support" eröffnen.</li>
					<li>eine Mail an support@xserv.net senden.</li>
				</ul>
			<br />
			<h3>Wie spiele ich auf Xserv WoW?</h3>
				<ol>
					<li>Bitte lies dir dazu zuerst unsere <a href="regeln.php">Serverregeln</a> durch.</li>
					<li>Installiere World of Warcraft 3.3.5a (Fertiger Spielordner <a href="http://adf.ly/qNf4N">downloaden</a>, sofort spielbar!).</li>
					<li>Falls noch nicht geschehen, erstell dir <a href="account.php">hier</a> einen Xserv-WoW-Account.</li>
					<li>Starte WoW über die Datei "wow.exe" und log dich mit deinen Accountdaten ein. Viel Spaß!</li>
				</ol>
			<br />
			<h3>Ich besitze bereits WoW, was muss ich tun um auf Xserv zu spielen?</h3>
				<ul>
					<li>Ist deine Version bereits 3.3.5a, musst du nur in deinem WoW-Ordner die Datei /Data/deDE/realmlist.wtf öffnen, den Inhalt löschen und Folgendes einfügen: <code>set realmlist xserv.net</code>.</li>
					<li>Wenn die Version deines Spiels älter als 3.3.5a ist, musst du zuerst die entsprechenden Patches bis zum Stand 3.3.5a aufspielen. Alle Patches finden sich <a href="http://wow.4fansites.de/downloadspatches.php">hier</a>.</li>
					<li>Besitzt du eine neuere Version als 3.3.5a (4.x.x, 5.x.x oder 6.x.x) dann musst du WoW leider nochmal installieren. Die Möglichkeit eines Downgrades auf 3.3.5a besteht leider nicht.</li>
				</ul>
			<br />
			<h3>Immer wenn ich mich einlogge will mein WoW hochpatchen.</h3>
				<ul>
					<li>Bitte achte darauf, WoW nicht mit der "Launcher.exe" sondern mit der "wow.exe" zu starten.</li>
					<li>Außerdem darfst du dich beim Anmeldefenster nicht mit deiner E-Mail anmelden. Bitte nutze den Accountnamen, den du bei der Accounterstellung eingegeben habt.</li>
					<li>Auch kann es sein, dass die Realmlist noch nicht auf Xserv umgestellt ist. Öffne dazu die Datei /Data/deDE/realmlist.wtf in eurem WoW-Ordner und achte darauf, dass dort nur <code>set realmlist xserv.net</code> steht.</li>
				</ul>
			<br />
			<h3>Ich kann mich nicht zum Server verbinden.</h3>
				Das kann verschiedene Gründe haben:
				<ul>
					<li>Der Loginserver ist momentan nicht erreichbar. Das wird nur von kurzer Dauer sein und es gibt dazu wahrscheinlich ein Eintrag im Forum.</li>
					<li>Die Realmlist wurde falsch eingestellt. Öffne dazu die Datei /Data/deDE/realmlist.wtf in deinem WoW-Ordner und achte darauf, dass dort nur <code>set realmlist xserv.net</code> steht.</li>
					<li>Es gibt Probleme mit deiner Internetvebindung.</li>
				</ul>
			<br />
			<h3>Ich habe mein Passwort vergessen.</h3>
				Du kannst dein Passwort jederzeit zurücksetzen. Dazu einfach auf der Account-Seite auf "Passwort vergessen" klicken.
		</div>
	</article>
	<hr class="main">
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>

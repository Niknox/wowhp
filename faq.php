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
				Du erhältst auf Xserv Support über Teamspeak, E-Mail, das Forum oder direkt ingame.
				<ul>
					<li>Geh im Teamspeak (IP: xserv.net) in den WoW-Support-Channel, ein Teammitglied wird sich um dich kümmern.</li>
					<li>Eröffne im Spiel ein Ticket; dazu unten in der Menüleiste auf das rote Fragezeichen und dann auf "Ticket erstellen" klicken.</li>
					<li>Erstelle ein neues Thema im Forum unter "Support".</li>
					<li>Sende uns eine Mail an support@xserv.net</li>
				</ul>
			<br />
			<h3>Wie spiele ich auf Xserv WoW?</h3>
				<ol>
					<li>Bitte lest euch dazu zuerst unsere <a href="regeln.html">Serverregeln</a> durch.</li>
					<li>Installiert World of Warcraft 3.3.5a (Fertiger Spielordner <a href="http://adf.ly/qNf4N">downloaden</a>, sofort spielbar!).</li>
					<li>Falls noch nicht geschehen, erstellt euch <a href="account.php">hier</a> einen WoW-Account.</li>
					<li>Startet WoW über die Datei "wow.exe" und loggt euch mit euren Accountdaten ein. Viel Spaß!</li>
				</ol>
			<br />
			<h3>Ich besitze bereits WoW, was muss ich tun um auf Xserv zu spielen?</h3>
				<ul>
					<li>Ist eure Version bereits 3.3.5a, müsst ihr nur in eurem WoW-Ordner die Datei /Data/deDE/realmlist.wtf öffnen, den Inhalt löschen und Folgendes einfügen: <code>set realmlist xserv.net</code>.</li>
					<li>Wenn die Version eures Spiels älter als 3.3.5a ist, müsst ihr zuerst die entsprechenden Patches bis zum Stand 3.3.5a aufspielen. Alle Patches finden sich <a href="http://wow.4fansites.de/downloadspatches.php">hier</a>.</li>
					<li>Besitzt ihr eine neuere Version als 3.3.5a (4.x.x, 5.x.x oder 6.x.x) dann müsst ihr WoW leider nochmal installieren. Die Möglichkeit eines Downgrades auf 3.3.5a besteht leider nicht.</li>
				</ul>
			<br />
			<h3>Immer wenn ich mich einlogge will mein WoW hochpatchen.</h3>
				<ul>
					<li>Bitte achtet darauf, WoW nicht mit der "Launcher.exe" sondern mit der "wow.exe" zu starten.</li>
					<li>Außerdem dürft ihr euch beim Anmeldefenster nicht mit eurer E-Mail anmelden. Bitte nutzt den Accountnamen, den ihr bei der Accounterstellung eingegeben habt.</li>
					<li>Auch kann es sein, dass die Realmlist noch nicht auf Xserv umgestellt ist. Öffnet dazu die Datei /Data/deDE/realmlist.wtf in eurem WoW-Ordner und achtet darauf, dass dort nur <code>set realmlist xserv.net</code> steht.</li>
				</ul>
			<br />
			<h3>Ich kann mich nicht zum Server verbinden.</h3>
				Das kann verschiedene Gründe haben:
				<ul>
					<li>Der Loginserver ist momentan nicht erreichbar. Das wird nur von kurzer Dauer sein und es gibt dazu wahrscheinlich ein Eintrag im Forum.</li>
					<li>Die Realmlist wurde falsch eingestellt. Öffnet dazu die Datei /Data/deDE/realmlist.wtf in eurem WoW-Ordner und achtet darauf, dass dort nur <code>set realmlist xserv.net</code> steht.</li>
					<li>Es gibt Probleme mit eurer Internetvebindung.</li>
				</ul>
			<br />
			<h3>Ich habe mein Passwort vergessen.</h3>
				Ihr könnt euer Passwort jederzeit zurücksetzen. Dazu einfach auf der Account-Seite auf "Passwort vergessen" klicken.
		</div>
	</article>
	<hr class="main">
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>

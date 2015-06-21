<?php include('auth.php'); ?>
<!DOCTYPE html>
<html lang="de">
<head>
	<title>Xserv WoW: Spenden</title>
	<?php include('head.php');?>
</head>
<body>
	<?php include('nav.php');?>
	<hr class="main">
	<article>
		<h3>Spendenformular</h3>
		<?php
			require_once 'mysql.php';
			$username = $_SESSION["username"];
			function test_input($data)
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<label for="payment">Zahlungsweise:</label><select name="payment" id="payment" style="width:195px;">
				<option value="bank">Banküberweisung</option>
				<option value="pp">PayPal</option>
				<option value="psc">Paysafecard</option>
			</select><br />
			<label for="sum">Betrag in €:</label><input type="number" name="sum" id="sum" min="1" max="100" required style="width:191px;"><br />
			<label for="message">Nachricht:</label><textarea name="message" id="message" rows="7" cols="10" style="width:193px;" maxlength="500" placeholder="Weitere Anmerkungen hier einfügen."></textarea><br />
			<input type="submit" name="submit" value="Submit" class="button">
			<?php
				$text = test_input($_POST["message"]);
				$textIns = mysqli_real_escape_string($connect, $text);
				$payment = $_POST["payment"];
				$sum = $_POST["sum"];
				if (!mysqli_connect_errno())
				{
					if ($_SERVER["REQUEST_METHOD"] == "POST")
					{
						$success = "Vielen Dank für deine Spendenanfrage! Du erhältst außerdem eine Bestätigungsmail mit weiteren Informationen.";
						$created = date("d.m.Y H:i:s");
						$created2 = date("Y-m-d H:i:s");
						$query = "INSERT INTO `donation_requests` (username, date, payment, notes, receipt, sum) VALUES ('$username', '$created2', '$payment', '$textIns', 0, '$sum')";
						mysqli_query($connect,$query);
						$query2 = "SELECT `email` FROM `account` WHERE `username`='$username'";
						if ($result = mysqli_query($connect,$query2))
						{
							$row = mysqli_fetch_assoc($result);
							$email = $row["email"];
							mysqli_free_result($result);
						}
						$subject = "'Spendenanfrage von ' + '$username'";
						$headers   = array();
						$headers[] = "MIME-Version: 1.0";
						$headers[] = "Content-type: text/plain; charset=utf-8";
						$headers[] = "From: Xserv WoW <admin@xserv.net>";
						$headers[] = "Reply-To: Xserv WoW <admin@xserv.net>";
						$headers[] = "Subject: {$subject}";
						$headers[] = "X-Mailer: PHP/".phpversion();
						$mailtext = "Benutzer: $username\nZahlungsweise:$payment\nAnmerkung:$text\nZeitpunkt:$created";
						mail('admin@xserv.net', $subject, $mailtext, implode("\r\n", $headers));
						
						$sUsername = strtolower($username);
						$subject = "Spendenbestätigung";
						$mailtext   = array();
						$mailtext[] = "Hallo $sUsername,\n\n";
						$mailtext[] = "vielen Dank für deine Spendenanfrage vom $created. Hier findest du Informationen zum weiteren Ablauf.\n\n";
						$mailtext[] = "Je nachdem, welche Zahlungsart du gewählt hast, liegt es jetzt an dir, die Spende an uns weiterzuleiten.\n\n";
						$mailtext[] = "Bei Banküberweisung: Bitte überweise uns den Betrag an die folgende Bankverbindung:\n";
						$mailtext[] = "Bei PayPal: Bitte sende uns das Geld an folgende PayPal-Adresse:\n";
						$mailtext[] = "Bei PaySafeCard: Bitte sende uns den 16-stelligen Code als Antwort an diese Mail zu, sodass wir das Guthaben abbuchen können.\n\n";
						$mailtext[] = "Xserv und die Community bedanken sich bei dir herzlich für deine Spende!\n\n";
						$mailtext[] = "Die Spendenpunkte werden dir gutgeschrieben sobald wir einen Zahlungseingang erhalten haben.\n\n";
						$mailtext[] = "Du erhältst eine weitere Bestätigungsmail wenn wir den Zahlungseingang verbuchen konnten und dir die Punkte gutgeschrieben wurden.\n\n";
						$mailtext[] = "Solltest du noch irgendwelche Fragen zur Abwicklung oder Probleme haben, antworte einfach auf diese Mail.\n\n";
						$mailtext[] = "Vielen Dank und viel Spaß weiterhin auf Xserv WoW!";
						mail($email, $subject, implode($mailtext), implode("\r\n", $headers));
						
						mysqli_close($connect);
					}
				}
			?>
			<br /><span class="success"><?php echo $success;?></span>
		</form>
	</article>
	<hr class="main">
	<footer>
	<?php include('footer.php');?>
	</footer>
</body>
</html>
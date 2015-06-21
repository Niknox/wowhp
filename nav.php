<?php
	session_start();
	if (isset($_SESSION['username']))
	{
		$login = '<div class="login"><a href="logout.php">Logout</a></div>';
		
	}
	else
	{
		$login = '<div class="login"><a href="login.php">Login</a></div>';
	}
?>
<header>
	<?php echo $login;?>
	<img id="logo" src="images/logo.png" alt="Xserv WoW Blizzlike">
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
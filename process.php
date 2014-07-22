<?php
$name = $pw = $pw2 = $email = "";
$nameErr = $pwErr = $emailErr = "";
$name_insert = $pw_insert = $email_insert = "";

$connect=mysqli_connect("localhost","trinity","","auth");
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$nametest = "SELECT * FROM `account` WHERE `username` = '$POST["name"]'";
		mysqli_query($connect,$nametest);
		$rows = mysqli_affected_rows($connect);
		if ($rows == 0)
			{
				if (!empty($_POST["name"]))
					{
						if (!preg_match("/^[a-zA-Z0-9]{2,20}$/",$name))
							{
								$name = test_input($_POST["name"]);
								$name_insert = mysqli_real_escape_string($connect, $name);
								if (!empty($_POST("pw"]))
									{
										if (($_POST["pw"]) != ($_POST["pw2"]))
											{
												if (!preg_match("/^(?=.*[A-Za-z])[a-zA-Z0-9!?$%&*+-.,]{6,16}$/",$pw))
													{
														$pw = test_input($_POST["pw"]);
														$pw_insert = mysqli_real_escape_string($connect, $pw);
														if (!empty($_POST["pw2"]))
															{
																$pw2 = test_input($_POST["pw2"]);
																if (!empty($_POST["email"]))
																	{
																		$email = test_input($_POST["email"]);
																		$email_insert = mysqli_real_escape_string($connect, $email);
																		$hash = SHA1(strtoupper($name_insert.':'.$pw_insert));
																		$sql="INSERT INTO `account` (username, sha_pass_hash, email, expansion, os)
																		VALUES ('$name_insert', '$hash', '$email_insert', '2', 'Win')";
																		if (!mysqli_query($connect,$sql))
																			{
																				die('Error: ' . mysqli_error($connect));
																			}
																		else
																			{
																				$success = "Account erfolgreich erstellt.";
																			}
																	}
																else
																	{
																		$emailErr = "Bitte gib eine E-Mail-Adresse ein.";
																	}
															}
														else
															{
																$pwErr = "Bitte gib ein Passwort ein.";
															}
													}
												else
													{
														$pwErr = "Das Passwort ist zu kurz, zu lang, oder enthält nicht erlaubte Zeichen. Erlaubt sind: A-Z, a-z, 0-9, !?$%&*+-.,";
													}
											}
										else
											{
												$pwErr = "Die Passwörter stimmen nicht überein.";
											}
									}
								else
									{
										$pwErr = "Bitte gib ein Passwort ein.";
									}
							}
						else
							{
								$nameErr = "Der Accountname enthält nicht erlaubte Zeichen. Erlaubt sind: Kleinbuchstaben, Großbuchstaben, Zahlen.";
							}
					}
				else
					{
						$nameErr = "Bitte gib einen Accountnamen ein.";
					}
			}
		else
			{
				$nameErr = "Accountname bereits vorhanden.";
			}
	}
mysqli_close($connect);
function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


?>
<!DOCTYPE HTML>
<?php
session_start();

//echo "<pre>";
//var_dump($_SESSION); // lub print_r($_SESSION);
//echo "</pre>"
?>
<html lang="pl">

<head>
	<script defer src='script.js'></script>
	<meta charset="utf-8" />
	<title>Teatr</title>
	<meta name="description" content="Teatr" />
	<meta name="keywords" content="teatr, rozrywka" />
	<meta name="author" content="Olaf" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
	<div class="container">
		<div class="leftcollumn">
			<div class="leftcollumncalendar">
				<table class="mycalendar">
					<tbody>
						<?php for ($row = 1; $row <= 5; $row++) { ?>
							<tr>
								<?php for ($cell = 1; $cell <= 7; $cell++) { ?>
									<td> 1</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="rightcollumn">
			<div class="rightcollumnrepertuarlist">
				<div class="rightcollumnrepertuarheader">Repertuar na dzis
					<?php
					if ((isset($_SESSION["zalogowano"])) && ($_SESSION["zalogowano"] == true)) {
						echo "<div class='error'>" . $_SESSION['Login'] . "</div>";
					} else {
						echo "<div class='loginButton'>Zaloguj</div>";
					} ?>
				</div>
				<div class="rightcollumnrepertuarempty">Przepraszamy tego dnia nie odbedzie sie zadne przedstawienie</div>
			</div>
		</div>
	</div>

























	<div class='loginBox'>
		<div class='loginBoxContainer'>
			<div class='loginBoxReturn'></div>
			<form action="connect.php" method="post">
				Login: <input type="text" name="login" /></p>
				Haslo: <input type="password" name="password" /></p>
				<?php
				if (isset($_SESSION["login_error"])) {
					echo "<div class='error'> ! " . $_SESSION['login_error'] . "</div>";  //pojawia sie komunikat o bledzie
					unset($_SESSION["login_error"]);
				}
				?>
				<input type="submit" value="zaloguj" /><br />
				<?php
				if (isset($_SESSION["udanarejestracja"])) {
					echo $_SESSION["udanarejestracja"];  //pojawia sie komunikat o bledzie
					unset($_SESSION["udanarejestracja"]); //odznacza sesje
				} else {
					echo "Nie masz jeszcze konta?";
					echo "<div class='loginBoxUser'>Utworz konto</div>";
				}
				?>
			</form>
		</div>


		<div class='userBoxContainer'>
			<form action="user.php" method="post">
				<div class='row'>
					<div class='rowHeader'>Nazwa: </div>
					<input type="text" value="<?php
												if (isset($_SESSION["backup_login"])) {
													echo $_SESSION["backup_login"];
													unset($_SESSION["backup_login"]);
												} ?>" name="nazwa" />
					<?php
					if (isset($_SESSION["error_login"])) {
						echo "<div class='error'> ! " . $_SESSION['error_login'] . "</div>";  //pojawia sie komunikat o bledzie
						unset($_SESSION["error_login"]); //odznacza sesje
					} ?>
				</div>
				<div class='row'>
					<div class='rowHeader'>E-mail: </div>
					<input type="text" value="<?php
												if (isset($_SESSION["backup_r"])) {
													echo $_SESSION["backup_r"];
													unset($_SESSION["backup_r"]);
												} ?>" name="email" />
					<?php
					if (isset($_SESSION["error_r"])) {
						echo "<div class='error'> ! " . $_SESSION['error_r'] . "</div>";
						unset($_SESSION["error_r"]); //odznacza sesje
					} ?>
				</div>
				<div class='row'>
					<div class='rowHeader'>Haslo: </div>
					<input type="password" name="haslo" />
					<?php
					if (isset($_SESSION["error_password"])) {
						echo "<div class='error'> ! " . $_SESSION['error_password'] . "</div>";
						unset($_SESSION["error_password"]); //odznacza sesje
					} ?>
				</div>
				<div class='row'>
					<div class='rowHeader'>Powtorz haslo: </div>
					<input type="password" name="powtorz_haslo" />
					<?php
					if (isset($_SESSION["error_passwordcheck"])) {
						echo "<div class='error'> ! " . $_SESSION['error_passwordcheck'] . "</div>";
						unset($_SESSION["error_passwordcheck"]); //odznacza sesje
					} ?>
				</div>
				<div class='row'>
					<label>
						<input type="checkbox" name="zasady" /> Akceptuje regulamin
					</label>
				</div>
				<?php
				if (isset($_SESSION["error_zasady"])) {
					echo "<div class='error'> ! " . $_SESSION['error_zasady'] . "</div>";
					unset($_SESSION["error_zasady"]); //odznacza sesje
				} ?>
				<div class='row'>
					<div class='loginBoxUser'>Powrot do logowania</div>
					<input type="submit" value="Zrobione" />
				</div>
			</form>
		</div>
	</div>
</body>

</html>
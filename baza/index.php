<!DOCTYPE HTML>
<?php
session_start();

?>
<html lang="pl">

<head>
	<script defer src='script/date.js'></script>
	<script defer src='script/openbox.js'></script>
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
		<div class="loginBar">
			<div class="date">
				<?php
				if (isset($_GET['focusdate'])) {
					$focusdate = $_GET['focusdate'];
					$focusdate = date('d.m.Y', strtotime($focusdate));
					if (strtotime($focusdate) === false) {
						$focusdate = date('Y.m.d');
					}
					//echo "Otrzymana wartość focusdate: " . $focusdate;
				} else {
					$focusdate = date('Y.m.d');
					//echo $focusdate;
				}
				echo 'Repertuar na: ' . $focusdate ?>
			</div>
			<?php
			if ((isset($_SESSION["zalogowano"])) && ($_SESSION["zalogowano"] == true)) {
				if ((isset($_SESSION["falo"])) && ($_SESSION["falo"] == true)) {
					echo "<div class='loginButton'><a href='uploadrepertuar.php'>Dodaj film</a></div>";
				}
				echo "<div class='loginButton'><a href='logout.php'>Wyloguj</a></div>";
				echo "<div class='error'>" . $_SESSION['Login'] . "</div>";
			} else {
				echo "<div class='loginButton'>Zaloguj</div>";
			} ?>
		</div>


		<div class='mainPage'>
			<div class="leftcollumn">
				<div class="leftcollumncalendar">
					<div class="calendarButton">
						<img src='css/resource/leftarrow.png'>
					</div>
					<div id="calendar">
						<table class="mycalendar">
							<div id="today"></div>
							<tbody>
								<?php for ($row = 1; $row <= 5; $row++) { ?>
									<tr>
										<?php for ($cell = 1; $cell <= 7; $cell++) { ?>
											<td></td>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="calendarButton">
						<img src='css/resource/rightarrow.png'>
					</div>
				</div>
			</div>

			<div class="rightcollumn">
				<div class="rightcollumnrepertuarlist">
					<?php
					require_once "data.php";
					try {
						if (isset($_GET['focusdate'])) {
							$focusdate = $_GET['focusdate'];
							if (strtotime($focusdate) === false) {
								$focusdate = date('Y-m-d');
							}
							//echo "Otrzymana wartość focusdate: " . $focusdate;
						} else {
							$focusdate = date('Y-m-d');
							//echo $focusdate;
						}
						$request = @new mysqli($dataName, $dataLogin, $dataPassword, $dataPath);
						if ($request->connect_errno != 0) {
							throw new Exception(mysqli_connect_errno());
						} else {
							$wynik = @$request->query(sprintf("SELECT * FROM repertuar WHERE date = '%s'", $focusdate));
							$ile_wyniki = $wynik->num_rows; //sprawdza ile znalazlo uzytkownikow
							if ($ile_wyniki > 0) {
								while ($informacje = $wynik->fetch_assoc()) {
									echo "<div class = 'rightcollumnrepertuar'>";

									echo "<div class = 'rightcollumnrepertuarelement'>";
									echo "<img src=repertuar/Photo/" . $informacje['photo'] . ">";
									echo "</div>";

									echo "<div class = 'rightcollumnrepertuarelement'>";
									echo "<div>";
									echo $informacje["name"];
									echo "</div>";
									echo "<div>";
									echo $informacje["description"];
									echo "</div>";
									echo "</div>";
									
									echo "<div class = 'rightcollumnrepertuarelement'>";
									echo "<div class = 'rightcollumnrepertuarelementquantity'>";
									echo "<div class='loginButton'>Kup Bilet</div>";
									echo "</div>";
									echo "</div>";

									echo "<div class = 'rightcollumnrepertuarelement'>";
									echo "<div id = 'rightcollumnrepertuarelementid'>";
									//$_SESSION["RepertuarId"] = $informacje["id"];
									echo $informacje["id"];
									echo "</div>";
									echo "</div>";


									echo "</div>";
								}
							} else {
								echo "<div class='rightcollumnrepertuarempty'>Przepraszamy tego dnia nie odbedzie sie zadne przedstawienie</div>";
							}
						}
						$request->close();
					} catch (Exception $error) {
						echo "Serwer w tym momencie jest wylaczony, prosimy o zarejestrowanie sie pozniej"; //dla uzytkownika
						echo "<br /> Dokladna informacja: " . $error;
					} ?>
				</div>
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


	<div class="numberofticket">
		<div class="numberofticketcontainer">
			<div class='loginBoxReturn'></div>
			<div id='location'>
				<table class="locationlist">
					<tbody>
						<?php
						$x = 25; // Liczba komórek w tabeli
						$y = 10;
						$fullRows = floor($x / $y);
						$extraCells = $x % 10;
						for ($row = 1; $row <= $fullRows; $row++) {
							echo "<tr>";
							for ($cell = 1; $cell <= 10; $cell++) {
								$cellnumber = $y * ($row - 1) + $cell;
								echo "<td style=cursor:auto>$cellnumber</td>";
							}
							echo "</tr>";
						}
						if ($extraCells > 0) {
							echo "<tr>";
							for ($cell = 1; $cell <= $extraCells; $cell++) {
								$cellnumber = $cellnumber + 1;
								echo "<td style=cursor:auto>$cellnumber</td>";
							}
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class='numberofticketcontainer ticketcontainer'>
			<div class='loginBoxReturn'></div>
			<?php
			if ((!isset($_SESSION["zalogowano"])) || ($_SESSION["zalogowano"] == false)) {
				echo "<div class='nologinerror'>ZALOGUJ SIE ABY KUPIC BILET</div>";
			} else {
				echo "<div class='nologinerror'>Wybrales miejsce numer: </div>";
				echo "<div class='loginButton'>Kup Bilet</div>";
			} ?>
		</div>
	</div>
</body>

</html>

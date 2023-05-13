<!DOCPTYPE HTML>
<html lang ="pl">
<head>
	<meta charset = "utf-8"/>
	<title>Wyniki dzialan</title>
</head>
<body>
	<?php
		$A = $_POST['liczbaA'];
		$B = $_POST['liczbaB'];
		$dodawanie = $A+$B;
		$odejmowanie = $A-$B;
		$mnozenie = $A*$B;
		if ($B == 0)
			{
			$dzielenie = "Nie można podzielic przez 0!";
			}
		else
			{
			$dzielenie = $A/$B;
			}
echo <<< END
		<h2>Wyniki dzialan:</h2>
		<table border = "1" cellpadding = "10" cellspacing = "0" >
		<tr>
			<td>Dodawanie:</td>
			<td>$dodawanie</td>
		</tr>
		<tr>
			<td>Odejmowanie:</td>
			<td>$odejmowanie </td>
		</tr>
		<tr>
			<td>Mnozenie:</td>
			<td>$mnozenie</td>
		</tr>
		<tr>
			<td>Dzielenie:</td>
			<td>$dzielenie</td>
		</tr>
		</table>
		<br/><br>
		<a href = "index.php" >Powrot do strony glownej</a>
END;
	?>
</body>
</html>
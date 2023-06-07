<?php
session_start();
if ((!isset($_SESSION["falo"])) || ($_SESSION["falo"] == false)) {
	header("Location: index.php");
	exit();
}

if (isset($_POST["uploadData"])) {
	$data_correct = true;

	$date = $_POST["date"];
	$name = $_POST["nazwa"];
	$description = $_POST["opis"];
	$time = $_POST["time"];
	if (empty($time)) {
		$_SESSION["error"] = "Time: Wpisz poprawne wartosci";
		header("Location: uploadrepertuar.php");
		exit();
	}
	if (empty($date)) {
		$_SESSION["error"] = "Date: Wpisz poprawne wartosci";
		header("Location: uploadrepertuar.php");
		exit();
	}
	if (empty($name)) {
		$name = "test";
	}
	if (empty($description)) {
		$description = "test test";
	}


	if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
		echo "<pre>";  //pobieranie danych do nastepnego etaptu
		print_r(($_FILES["foto"]));
		echo "</pre>";

		$photo_data = $_FILES["foto"]["name"];
		$photo_large = $_FILES["foto"]["size"];
		$photo_copy = $_FILES["foto"]["tmp_name"];
		$photo_error = $_FILES["foto"]["error"];

		if ($photo_error == 0) {
			if ($photo_large > 125000) {
				$_SESSION["photo_error"] = "Zbyt duzy plik";
				header("Location: uploadrepertuar.php");
				exit();
			}
			$photo_extension = pathinfo($photo_data, PATHINFO_EXTENSION); //pobiera rozszerzenie pliku
			$photo_validate = strtolower($photo_extension);
			$photo_access = array("png"); //przepuszcza pliki z tym formatem
			if (!in_array($photo_validate, $photo_access)) {
				$_SESSION["photo_error"] = "Nieprawidlowe rozszerzenie pliku";
				header("Location: uploadrepertuar.php");
				exit();
			}
			$photo_local = uniqid("Photo-", true) . "." . $photo_validate;
			$photo_path = "repertuar/Photo/" . $photo_local;
			move_uploaded_file($photo_copy, $photo_path);
		} else {
			$_SESSION["photo_error"] = "Uszkodzony plik";
			header("Location: uploadrepertuar.php");
			exit();
		}
	} else {
		$photo_local = "klocek.png";
	}

	require_once "data.php";
	try {
		$request = @new mysqli($dataName, $dataLogin, $dataPassword, $dataPath);
		if ($request->connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		} else {
			if ($request->query("INSERT INTO repertuar VALUES (NULL, '$date', '$name', '$description','$photo_local')")) {
				header("Location: uploadrepertuar.php");
			} else {
				throw new Exception($request->error);
			}
		}
		$request->close();
	} catch (Exception $error) {
		$_SESSION["error"] = $error;
		header("Location: uploadrepertuar.php");
		exit();
	}
} else {
	$_SESSION["error"] = "Dodaj repertuar";
	header("Location: uploadrepertuar.php");
	exit();
}

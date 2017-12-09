<?php
session_start();

if ($_SESSION['LOGGED_ON'])
{
	if (!file_exists("./pics"))
		mkdir("./pics");
	$filter = "./ressources/filters/" . $_GET['filter'] . ".png";
	$filedata = file_get_contents("./pics/" . $_GET['data']);
	$filepath = "./pics/";
	$filesql = $_SESSION['LOGGED_ON'] . " " . time() . '.png';
	$filename = $filepath . $_SESSION['LOGGED_ON'] . " " . time() . '.png';
	file_put_contents($filename, $filedata);

	if (file_exists($filter))
	{
		$dest = imagecreatefromstring($filedata);
		$src = imagecreatefrompng($filter);
		$src = imagescale($src, imagesx($dest) * 0.5);
		imagecopy($dest, $src, 0, 0, 0, 0, imagesx($src) - 1, imagesy($src) - 1);
		imagepng($dest, $filename);
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$req = $conn->prepare('INSERT INTO Photos (username, timet, url, UserID) VALUES (:username, NOW() , :url, :userID)');
		$req->execute(array(
			':username' => $_SESSION['LOGGED_ON'],
			':url' => $filesql,
			':userID' => $_SESSION['ID']
		));
	}

	catch(PDOException $e)
	{
		echo "Couldn't write in Database: " . $e->getMessage();
	}

	header("location:index.php");
}

 ?>
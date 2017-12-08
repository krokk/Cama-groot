<?php

	if (!file_exists("./pics"))
		mkdir("./pics");
	try
	{
		$conn = new PDO("mysql:host=localhost", "root", "root");
		$req = "CREATE DATABASE db_camagru";
		$req = $conn->prepare($req);
		$req->execute();
		header("location:index.php");
	}
	catch(PDOException $e)
	{
		echo "Error creating DataBase: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`users` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`username` VARCHAR(255) NOT NULL,
			`email` VARCHAR(255) NOT NULL,
			`conflink` VARCHAR(255),
			`activated` INT NOT NULL DEFAULT 0,
			`password` VARCHAR(255) NOT NULL,
			`avatar` VARCHAR(255),
			`resetpsw` INT NOT NULL DEFAULT 0,
			`emailcomment` INT NOT NULL DEFAULT 0,
			PRIMARY KEY (`id`));
		  ";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`following` (
			`userID` INT NOT NULL,
			`followinguserID` INT NOT NULL,
			PRIMARY KEY (`userID`));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`Photos` (
		`PhotoID` INT NOT NULL AUTO_INCREMENT,
		`username` VARCHAR(255) NOT NULL,
		`timet` DATETIME NOT NULL,
		`url` VARCHAR(255) NOT NULL,
		PRIMARY KEY (`PhotoID`));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`comments` (
		`CommentID` INT NOT NULL AUTO_INCREMENT,
		`photoID` INT NOT NULL,
		`author` VARCHAR(255) NOT NULL,
		`timet` DATETIME NOT NULL,
		`text` VARCHAR(255) NOT NULL,
		PRIMARY KEY (`CommentID`));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`likes` (
		`LikeID` INT NOT NULL AUTO_INCREMENT,
		`photoID` INT NOT NULL,
		`UserID` INT NOT NULL,
		PRIMARY KEY (LikeID));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	$conn = null;
?>

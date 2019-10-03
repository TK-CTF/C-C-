<?php
	require_once('config.php');
	session_start();
	$token = filter_input(INPUT_POST, 'token');
	if (empty($_SESSION['token']) || $token !== $_SESSION['token']) {
		die("connect to my website properly");
	}
	// connect to DB and create table if not exists
	try {
		$pdo = new PDO(DSN, DB_USER, DB_PASS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// SQL Injection
		$pdo->exec("CREATE TABLE IF NOT EXISTS userData(
		id INT NOT NULL auto_increment PRIMARY KEY,
		email VARCHAR(255),
		password VARCHAR(255),
		created TIMESTAMP NOT NULL default current_timestamp
	)");
	} catch (Exception $e) {
		echo $e->getMessage() . PHP_EOL;
	}
	// Validate POST
	if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo 'POST is invalid';
		return false;
	}
	// RegularExpression for password
	if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	} else {
		echo 'Set password with at least 8 characters, including both of alphabets and digits at least';
		return false;
	}
	// Sign up
	try {
		// SQL Injection
		$stmt = $pdo->prepare("INSERT INTO userDeta(email, password) VALUE(?, ?)");
		$stmt->execute([$email, $password]);
		echo 'Signed up';
	} catch (\Exception $e) {
		echo 'email has already been taken';
	}
?>
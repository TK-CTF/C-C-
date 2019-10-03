<?php
	require_once('config.php');
	session_start();
	// validate POST
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo 'POST is invalid';
		return false;
	}
	// search DB for POSTed email
	try {
		$pdo = new PDO(DSN, DB_USER, DB_PASS);
		$stmt = $pdo->prepare('SELECT * FROM userData WHERE email = ?');
		$stmt->execute([$_POST['email']]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (\Exception $e) {
		echo $e->getMessage() . PHP_EOL;
	}
	// check if email exists in DB
	if (!isset($row['email'])) {
		echo 'email or password is wrong';
		return false;
	}
	// after varifying password, transmit email to session
	if (password_verify($_POST['password'], $row['password'])) {
		//regenerate new session_id to replace old one
		session_regenerate_id(true);
		$_SESSION['EMAIL'] = $row['email'];
		echo 'Signed in';
	} else {
		echo 'email or password is wrong';
		return false;
	}
?>
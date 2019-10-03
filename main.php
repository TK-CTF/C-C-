<?php
	function h($s){
		return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
	}
	session_start();
	// if a user has already logged in
	if (isset($_SESSION['EMAIL'])) {
		echo 'Welcome, ' .  h($_SESSION['EMAIL']) . "<br>";
		echo "<a href='/signout.php'>Sign out!</a>";
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>main</title>
</head>
<body>
	<h1>Sign in with existing account</h1>
	<form  action="signin.php" method="post">
		<label for="email">email</label>
		<input type="email" name="email">
		<label for="password">password</label>
		<input type="password" name="password">
		<button type="submit">Sign In!</button>
	</form>
	<h1>Create a new account</h1>
	<form action="signup.php" method="post">
		<label for="email">email</label>
		<input type="email" name="email">email
		<label for="password">password</label>
		<input type="password" name="password">
		<button type="submit">Sign Up!</button>
		<p>Set password with at least 8 characters, including both of alphabets and digits at least</p>
	</form>
</body>
</html>
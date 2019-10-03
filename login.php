<?php
	// Cross-Site Scripting(XSS)
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
	// generate token if not exists
	if (empty($_SESSION['token'])) {
		$token = bin2hex(random_bytes(24));
		$_SESSION['token'] = $token;
	} else {
		$token = $_SESSION['token'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
</head>
<body>
	<!--Cross-Site Request Forgery(CSRF)-->
	<h2>Sign in with existing account</h2>
	<form  action="signin.php" method="post">
		<div>email<input type="email" name="email" value="
			<?php echo htmlspecialchars($token, ENT_QUOTES, 'utf-8'); ?>
		"></div>
		<div>password<input type="password" name="password"></div>
		<button type="submit">Sign In!</button>
	</form>
	<h2>Create a new account</h2>
	<form action="signup.php" method="post" value="
		<?php echo htmlspecialchars($token, ENT_QUOTES, 'utf-8'); ?>
	">
		<div>email<input type="email" name="email"></div>
		<div>password<input type="password" name="password"></div>
		<button type="submit">Sign Up!</button>
		<p>Set password with at least 8 characters, including both of alphabets and digits at least</p>
	</form>
</body>
</html>
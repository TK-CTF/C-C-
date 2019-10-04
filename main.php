<?php
session_start();

require 'database.php';
$login_user = $_SESSION['login_user'];
?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        <?php foreach ($login_user as $key => $val) : ?>
            <p><?php echo h($key); ?> : <?php echo h($val); ?></p>
        <?php endforeach; ?>
        <div><a href="chat.html">chat</a></div>
	<div><a href="calendar.html">calendar</a></div>
    </body>
</html>
<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();

require 'database.php';

$err = [];

// �u���O�C���v�{�^����������āAPOST�ʐM�̂Ƃ�
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $user_name = filter_input(INPUT_POST, 'user_name');
    $password = filter_input(INPUT_POST, 'password');
    $password_conf = filter_input(INPUT_POST, 'password_conf');

    if ($user_name === '') {
        $err['user_name'] = '���[�U�[���͓��͕K�{�ł��B';
    }
    if ($password === '') {
        $err['password'] = '�p�X���[�h�͓��͕K�{�ł��B';
    }
    if ($password !== $password_conf) {
        $err['password_conf'] = '�p�X���[�h����v���܂���B';
    }

    // �G���[���Ȃ��Ƃ�
    if (count($err) === 0) {

        // DB�ڑ�
        $pdo = connect();

        // �X�e�[�g�����g
        $stmt = $pdo->prepare('INSERT INTO `User` (`id`, `user_name`, `password`) VALUES (null, ?, ?)');

        // �p�����[�^�ݒ�
        $params = [];
        $params[] = $user_name;
        $params[] = password_hash($password, PASSWORD_DEFAULT);

        // SQL���s
        $success = $stmt->execute($params);
    }
}
?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <?php if (count($err) > 0) : ?>
            <?php foreach ($err as $e): ?>
                <p class="error"><?php echo h($e); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($success) && $success) : ?>
            <p>�o�^�ɐ������܂����B</p>
            <p><a href="index.php">�����炩�烍�O�C�����Ă��������B</a></p>
        <?php else: ?>
            <form action="" method="post">
                <p>
                    <label for="user_name">���[�U�[��</label>
                    <input id="user_id" name="user_name" type="text" />
                </p>
                <p>
                    <label for="">�p�X���[�h</label>
                    <input id="password" name="password" type="password" />
                </p>
                <p>
                    <label for="">�m�F�p�p�X���[�h</label>
                    <input id="password_conf" name="password_conf" type="password" />
                </p>
                <p>
                    <button type="submit">���O�C��</button>
                </p>
                <p>
                    <a href="adduser.php">�V�K���[�U�[�o�^</a>
                </p>
            </form>
        <?php endif; ?>
    </body>
</html>
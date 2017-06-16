<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 13:16
 */

session_start();
unset($_SESSION['email']);
unset($_SESSION['pass']);
unset($_SESSION['data']);


?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログアウト</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>ログアウト完了しました</h1>

<a href="/">トップページはこちら</a>
<a href="signup.php">新規登録はこちら</a>
<a href="login.php">ログインはこちらから</a>

</body>
</html>


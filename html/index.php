<?php
/**
 * index.php
 * ログインor登録ページ
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 13:55
 */

session_start();
if ($_SESSION['email'] && $_SESSION['pass']) {
    header('Location: top-page.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>トップページ</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>トップページ</h1>

<a href="signup.php">登録はこちらから</a>
<a href="login.php">ログインはこちらから</a>

<br><br>
以下 外部ページと仮定<br>
<a href="login.php?url=/trap/trap3.php">！罠その３（ログイン処理が必要な用に見せかける）</a>


</body>
</html>


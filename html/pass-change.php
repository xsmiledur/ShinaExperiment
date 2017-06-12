<?php
/**
 *
 * 『「重要な処理」の際に混入する脆弱性』（安全なWebアプリケーションの作り方 p141~）
 * パスワード変更処理を題材にして
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 15:03
 */

session_start();
$email = $_SESSION['email'];
if ($email = '') die('ログインしてください');


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パスワード変更</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>パスワード変更</h1>
<form action="pass-comp.php" method="POST">
    新パスワード<input name="pass" type="password">
    <button type="submit">パスワード変更</button>
</form>
<a href="home.php">ホームページに戻る</a>


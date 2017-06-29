<?php
/**
 *
 * パスワード再発行ページ
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 15:03
 */

session_start();
if ($_SESSION['email'] && $_SESSION['pass']) {
    header('Location: top-page.php');
}
$msg = $_SESSION['errMsg'];
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パスワード再発行</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>パスワード再発行</h1>

<?php echo $msg; ?>


<form action="pass-update.php" method="POST">
    <table>
        <tbody>
        <tr>
            <th>Emailアドレス</th>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <th>Emailアドレス(確認)</th>
            <td><input type="text" name="email_cnf"></td>
        </tr>
        </tbody>
    </table>
    <button type="submit">パスワード再発行</button>
</form>
<a href="index.php">トップページへ戻る</a><br>
<a href="login.php">ログイン</a><br>
<a href="signup.php">新規登録</a>
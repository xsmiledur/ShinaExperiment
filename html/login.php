<?php
/**
 * index.php
 * ログインページ
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
    <title>ログイン</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>ログインページ</h1>


<form action="auth.php?url=<?php echo @$_GET['url']; ?>" method="POST">
    <table>
        <tbody>
        <tr>
            <th>Emailアドレス</th>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td><input type="password" name="pass"></td>
        </tr>
        </tbody>
    </table>
    <button type="submit">ログイン</button>
</form>
<a href="/">トップページへ戻る</a><br>
<a href="forget.php">パスワードを忘れた場合</a><br>
<a href="signup.php">新規登録</a>
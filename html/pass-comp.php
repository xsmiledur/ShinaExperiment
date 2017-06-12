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

function ex($s) { //XSS対策用のHTMLエスケープと表示関数
    echo htmlspecialchars($s, ENT_COMPAT, 'UTF-8');
}

session_start();
$email = $_SESSION['email'];
$pass  = @$_POST['pass'];
var_dump($email);var_dump($pass);

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

<h1>パスワード変更完了</h1>
<?php echo $name; ?>さんのパスワードを<?php echo ex($pass); ?>に変更しました。
<a href="home.php">ホームページに戻る</a>


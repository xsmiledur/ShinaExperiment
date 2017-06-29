<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 13:10
 */

session_start();
$data = $_SESSION['data'];

if (!$data || !$data['email'] || !$data['pass']) {
    header(('Location: index.php'));
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ホームページ</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>ホームページ</h1>

あなたの情報
<table>
    <thead>
    <tr>
        <th>項目名</th>
        <th>フォーム</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>名前</th>
        <td><?php echo $data['name']; ?></td>
    </tr>
    <tr>
        <th>Emailアドレス</th>
        <td><?php echo $data['email']; ?></td>
    </tr>
    <!--<tr>
        <th>パスワード</th>
        <td><?php echo $pass; ?></td>
    </tr>-->
    <tr>
        <th>年齢</th>
        <td><?php echo $data['age']; ?></td>
    </tr>
    <tr>
        <th>性別</th>
        <td><?php echo $data['sex']; ?></td>
    </tr>
    <tr>
        <th>誕生日</th>
        <td><?php echo $data['birth']; ?></td>
    </tr>
    <tr>
        <th>出身大学</th>
        <td><?php echo $data['univ']; ?></td>
    </tr>
    </tbody>
</table>

<a href="edit.php">ユーザ情報編集</a><br>
<a href="pass-change.php">パスワード変更</a><br>
<a href="logout.php">ログアウト</a><br>
<br>
<a href="search.php">蔵書検索</a><br>
<a href="user.php">ユーザ検索</a>

<br><br>
----以下 罠サイト----<br><br>


<a href="trap/trap1.php">！罠その１（パスワードを勝手に変更）</a><br>
<a href="trap/trap2.php">！罠その２（クッキー値を盗み出す）</a><br>

<br>
<!--<a href="trap/set-cookie.php">クッキーをセットするページ</a><br>-->
<!--<a href="mail.php">！罠その４（メール送信の問題）</a>-->



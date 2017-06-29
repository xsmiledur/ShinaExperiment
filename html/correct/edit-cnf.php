<?php
/**
 *
 * ユーザ情報編集確認
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 16:25
 */

session_start();

$data = $_SESSION['data'];
if (!$data || !$data['email'] || !$data['pass']) header('Location: index.php');

$update['email'] = @$_POST['email'];
$update['name'] = @$_POST['name'];
$update['sex'] = @$_POST['sex'];
$update['age'] = @$_POST['age'];
$update['univ'] = @$_POST['univ'];
$update['birth'] = @$_POST['birth'];

$_SESSION['update'] = $update;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザ情報変更確認</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>ユーザ情報変更確認</h1>
<form action="edit-comp.php" method="POST">
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
            <td><?php echo $update['name']; ?></td>
        </tr>
        <tr>
            <th>Emailアドレス</th>
            <td><?php echo $update['email']; ?></td>
        </tr>
        <tr>
            <th>年齢</th>
            <td><?php echo $update['age']; ?></td>
        </tr>
        <tr>
            <th>性別</th>
            <td><?php echo $update['sex']; ?></td>
        </tr>
        <tr>
            <th>誕生日</th>
            <td><?php echo $update['birth']; ?></td>
        </tr>
        <tr>
            <th>出身大学</th>
            <td><?php echo $update['univ']; ?></td>
        </tr>
        </tbody>
    </table>
    <button type="submit">変更</button>
</form>
<a href="top-page.php">ホームページに戻る</a>

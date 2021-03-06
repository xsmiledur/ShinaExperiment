<?php
/**
 *
 * ユーザ情報編集
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 16:21
 */

session_start();
$data = $_SESSION['data'];
if (!$data || !$data['email'] || !$data['pass']) die('ログインしてください');

$_SESSION['id'] = $data['id'];

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザ情報変更</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>ユーザ情報変更</h1>
<form action="edit-cnf.php" method="POST">
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
            <td><input type="text" name="name" value="<?php echo $data['name']; ?>"></td>
        </tr>
        <tr>
            <th>Emailアドレス</th>
            <td><input type="text" name="email" value="<?php echo $data['email']; ?>"></td>
        </tr>
        <tr>
            <th>年齢</th>
            <td><input type="number" name="age" value="<?php echo $data['age']; ?>"></td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                <input type="radio" name="sex" value="男" <?php echo ($data['sex'] == "男") ? 'checked=""' : ''; ?>>男
                <input type="radio" name="sex" value="女" <?php echo ($data['sex'] == "女") ? 'checked=""' : ''; ?>>女
            </td>
        </tr>
        <tr>
            <th>誕生日</th>
            <td><input type="date" name="birth" value="<?php echo $data['birth']; ?>"></td>
        </tr>
        <tr>
            <th>出身大学</th>
            <td><input type="text" name="univ" value="<?php echo $data['univ']; ?>"></td>
        </tr>
        </tbody>
    </table>
    <button type="submit">確認</button>
</form>
<a href="top-page.php">ホームページに戻る</a>

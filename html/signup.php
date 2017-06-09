<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>登録ページ</h1>


<form action="confirm.php" method="POST">
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
        <td><input type="text" name="name"></td>
    </tr>
    <tr>
        <th>Emailアドレス</th>
        <td><input type="text" name="email"></td>
    </tr>
    <tr>
        <th>パスワード</th>
        <td><input type="password" name="pass"></td>
    </tr>
    <tr>
        <th>年齢</th>
        <td><input type="number" name="age"></td>
    </tr>
    <tr>
        <th>性別</th>
        <td>
            <input type="radio" name="sex" value="男">男
            <input type="radio" name="sex" value="女">女
        </td>
    </tr>
    <tr>
        <th>誕生日</th>
        <td><input type="date" name="birth"></td>
    </tr>
    <tr>
        <th>出身大学</th>
        <td><input type="text" name="univ"></td>
    </tr>
    </tbody>
</table>
<button type="submit">確認</button>
</form>

<a href="/">戻る</a>


</body>
</html>


<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 14:04
 */
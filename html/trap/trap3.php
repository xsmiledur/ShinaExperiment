<?php
/**
 *
 * 『4.7 リダイレクト処理にまつわる脆弱性』（安全なWebアプリケーションの作り方 p187~）
 * リダイレクト処理
 *
 * *** 罠ページ ***
 * ログインが間違っているとして再度ログイン情報を入力させる
 *
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 16:56
 */


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログインエラー</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>ログインページ</h1>

Emailまたはパスワードが違います。再度認証してください。
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
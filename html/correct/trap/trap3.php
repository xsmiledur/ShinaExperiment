<?php
/**
 *
 * 『4.7.1 リダイレクト処理にまつわる脆弱性 オープンリダイレクタ脆弱性』（安全なWebアプリケーションの作り方 p187~）
 * リダイレクト処理
 *
 * オープンリダイレクタ脆弱性を悪用した典型的な攻撃パターン
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
<form action="auth.php" method="POST"> <!--/trap/auth.php-->
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
<a href="../">トップページへ戻る</a><br>
<a href="../forget.php">パスワードを忘れた場合</a><br>
<a href="../signup.php">新規登録</a>
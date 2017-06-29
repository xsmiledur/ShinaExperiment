<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 14:03
 *
 * 『4.9 メール送信の問題』（安全なWebアプリケーションの作り方 p221~）
 *
 *
 * *** 罠ページ ***
 * ログインが間違っているとして再度ログイン情報を入力させる
 *
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 14:16
 */

session_start();
$data = $_SESSION['data'];

if (!$data || !$data['email'] || !$data['pass']) {
    header(('Location: index.php'));
}

$err = $_SESSION['err'];
echo ($err) ? '記入してください。' : '';
unset($_SESSION['err']);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール送信フォーム</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>メール送信フォーム</h1>

<form action="mail-send.php" method="POST"> <!--/trap/auth.php-->
    <table>
        <tbody>
        <tr>
            <th>件名</th>
            <td><input type="text" name="title" style="width: 100%;" value="<?php echo $err['title']; ?>"><br></td>
        </tr>
        <tr>
            <th>テキスト</th>
            <td><textarea name="body" style="width: 100%; height: 150px;"><?php echo $err['body']; ?></textarea></td>
        </tr>
        </tbody>
    </table>
    <button type="submit">送信</button>
</form>

<a href="top-page.php">トップページに戻る</a>

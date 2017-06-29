<?php
/**
 * login.php
 * ログインページ
 *
 * 『4.7.1 リダイレクト処理にまつわる脆弱性 オープンリダイレクタ脆弱性』（安全なWebアプリケーションの作り方 p187~）
 * リダイレクト処理
 *
 * オープンリダイレクタ脆弱性を悪用した典型的な攻撃パターン
 *
 * *** 脆弱性をカバーしたページ ***
 *
 * ①リダイレクト先のURLを固定
 * // 柔軟性がないため、今回は使用しない
 * ②リダイレクト先のURLを直接指定せず番号指定にする
 * // 物品の購入において利用者の意思の念押し等に用いるので、今回は省く
 * ③リダイレクト先のドメインをチェックする
 * // 今回はドメインがlocalhost:8081で共通なので対策のしようがない、省く
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 13:55
 */

session_start();
$data = $_SESSION['data'];
if ($data && $data['email'] && $data['pass']) {
    header('Location: top-page.php');
    exit();
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

<?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>


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
<a href="index.php">トップページへ戻る</a><br>
<a href="forget.php">パスワードを忘れた場合</a><br>
<a href="signup.php">新規登録</a>
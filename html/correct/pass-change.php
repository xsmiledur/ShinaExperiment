<?php
/**
 *
 * 『「重要な処理」の際に混入する脆弱性』（安全なWebアプリケーションの作り方 p141~）
 * パスワード変更処理を題材にして
 *
 * *** 脆弱性をカバーしたページ ***
 *
 * ①秘密情報(Token)の埋め込み
 * // 第三者に予測不可能なトークンを要求することにより、CSRF攻撃を防ぐことができる
 * ②パスワード再入力
 * ③Refererのチェック
 *
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 15:03
 */

session_start();
$data = $_SESSION['data'];
if (!$data || !$data['email'] || !$data['pass']) die('ログインしてください');

/*

if (!@$_POST['pass-check']) {
    $_SESSION['new-pass'] = $pass; //新規パスワードをセッション保存
    $_SESSION['newpassnum'] = $passNum; //新規パスワードの長さもセッション保存
    require_once('pass-check.html');
    exit();
} else {

    $pass = @$_POST['pass-check'];
    $pass = md5($pass);
    var_dump($pass);
    $email = $data['email'];
    var_dump($email);


    try {
        // データベースに接続
        $pdo = new PDO(
            'mysql:host=mydb;port=3306;charset=utf8;dbname=shina_exp;',
            'root',
            'password',
            [
                //PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/mysql/my.cnf',
                //PDO::MYSQL_ATTR_READ_DEFAULT_GROUP => 'client',
                //PDO::ATTR_EMULATE_PREPARES => false
            ]
        );

        //一番やばいパターン(埋め込み)
        $sql = "SELECT pass FROM user_data WHERE email = '$email' AND pass = '$pass';";
        $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);
        if ($stmt) {
            $res = $stmt->fetch();
        } else {
            var_dump($pdo->errorInfo()[2]);
        }

    } catch (PDOException $e) {

        die($e->getMessage());

    }
    var_dump($res['pass']);

    if ($pass != $res['pass']) {
        // 確認できず
        require_once('pass-check.html');
        exit();
    } else {
        // 確認完了
        $pass = $_SESSION['new-pass'];
        $passNum = $_SESSION['newpassnum'];
    }

}


*/

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

<h1>パスワード変更</h1>
<form action="pass-comp.php" method="POST">

    新パスワード<input name="pass" type="password">
    <button type="submit">パスワード変更</button>

    <!-- ①秘密情報(Token)の埋め込み-->
    <input type="hidden" name="token" value="<?php echo htmlspecialchars(session_id(), ENT_COMPAT, 'UTF-8'); ?>">
    <!----------------------------->

</form>
<a href="top-page.php">ホームページに戻る</a>


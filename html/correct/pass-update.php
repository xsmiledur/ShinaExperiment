<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 15:05
 */


session_start();
if ($_SESSION['email'] && $_SESSION['pass']) {
    header('Location: top-page.php');
}

$email = @$_POST['email'];
$email_cnf = @$_POST['email_cnf'];

if ($email != $email_cnf || !$email || !$email_cnf) {
    $_SESSION['errMsg'] = "Emailが間違っています";
    header('Location: forget.php');
}

try {
    // データベースに接続
    $pdo = new PDO(
        'mysql:host=mydb;port=3306;charset=utf8;dbname=shina_exp;',
        'root',
        'password',
        [
            //PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/mysql/my.cnf',
            //PDO::MYSQL_ATTR_READ_DEFAULT_GROUP => 'client',
            //PDO::ATTR_EMULATE_PREPARES => false //ここをfalseにしないとSQLインジェクションが起こる
        ]
    );

    $sql = "SELECT * FROM user_data WHERE email = '" . $email . "';";
    $stmt = $pdo->query($sql);
    if ($stmt) {
        $res = $stmt->execute();
        $data = $stmt->fetch();
    }

    if (!$stmt || !$data) {
        $_SESSION['errMsg'] = "このEmailは登録されておりません";
        header('Location: forget.php');
    }

} catch (PDOException $e) {

    die($e->getMessage());

}



?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パスワード再発行完了</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>パスワード再発行完了</h1>


新しいパスワードをEmailにお送りしました<br>
再度ログインを行ってください<br>
<a href="login.php">ログイン</a><br>

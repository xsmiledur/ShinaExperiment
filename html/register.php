<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 14:55
 */

$clm = array('name', 'email', 'pass', 'age', 'sex', 'birth', 'univ');

$data = array();
foreach ($clm as $name) {
    $data[":".$name] = @$_POST[$name];
}

try {

    // データベースに接続
    $pdo = new PDO('mysql:host=mydb;charset=utf8;dbname=shina_exp', 'root', 'password');

    $sql = "INSERT INTO user_data (name, email, pass, age, sex, birth, univ) VALUES (:name, :email, :pass, :age, :sex, :birth, :univ)";
    $stmt = $pdo -> prepare($sql);
    $res = $stmt->execute($data);


} catch (PDOException $e) {

    die($e->getMessage());

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

<h1>登録が完了しました</h1>

<a href="login.php">こちら</a>からログインできます
<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 15:03
 */


$email = @$_POST['email'];
$pass  = @$_POST['pass'];

$msg = "ログイン完了しました。<br>";

try {

    // データベースに接続
    $pdo = new PDO(
        'mysql:host=mydb;port=3306;charset=utf8;unix_socket=/var/run/mysqld/mysqld.sock;',
        'root',
        'password',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    /*
    $stmt = $pdo->prepare('SELECT * FROM tbl WHERE id = :id');
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $result = $stmt->execute();
    */


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

<h1>ホームページ</h1>

<?php echo $msg; ?>

あなたの情報
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
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <th>Emailアドレス</th>
        <td><?php echo $email; ?></td>
    </tr>
    <tr>
        <th>パスワード</th>
        <td><?php echo $pass; ?></td>
    </tr>
    <tr>
        <th>年齢</th>
        <td><?php echo $age; ?></td>
    </tr>
    <tr>
        <th>性別</th>
        <td><?php echo $sex; ?></td>
    </tr>
    <tr>
        <th>誕生日</th>
        <td><?php echo $birth; ?></td>
    </tr>
    <tr>
        <th>出身大学</th>
        <td><?php echo $univ; ?></td>
    </tr>
    </tbody>
</table>


<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 15:03
 */

session_start();

$email = (@$_POST['email']) ? @$_POST['email'] : $_SESSION['email'];
$pass  = (@$_POST['pass']) ? @$_POST['pass'] : $_SESSION['pass'];


if (!$email || !$pass) {
    die('ログイン失敗 ERROR1');
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
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    /*
    $sql = "SELECT * FROM user_data WHERE (email = '" . $email . "' AND pass = '".$pass."');";

    $data = $pdo->query($sql);
    var_dump($data);
    echo "<br><br>";
    */

    $sql = "SELECT * FROM user_data WHERE (email = :email AND pass = :pass);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $result = $stmt->execute();
    $data = $stmt->fetch();


} catch (PDOException $e) {

    die($e->getMessage());

}

if (!$data) {
    die('ログイン失敗 ERROR2');
}

$_SESSION['email'] = $email;
$_SESSION['name'] = $data['name'];
$_SESSION['pass'] = $pass;

/* もし遷移先があればリダイレクト */
$url = @$_GET['url'];
if ($url) {
    header('Location: '. $url);
    exit();
}

$msg = "ログインしました。<br>";


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

<br>
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
        <td><?php echo $data['name']; ?></td>
    </tr>
    <tr>
        <th>Emailアドレス</th>
        <td><?php echo $email; ?></td>
    </tr>
    <!--<tr>
        <th>パスワード</th>
        <td><?php echo $pass; ?></td>
    </tr>-->
    <tr>
        <th>年齢</th>
        <td><?php echo $data['age']; ?></td>
    </tr>
    <tr>
        <th>性別</th>
        <td><?php echo $data['sex']; ?></td>
    </tr>
    <tr>
        <th>誕生日</th>
        <td><?php echo $data['birth']; ?></td>
    </tr>
    <tr>
        <th>出身大学</th>
        <td><?php echo $data['univ']; ?></td>
    </tr>
    </tbody>
</table>

<a href="pass-change.php">パスワード変更</a>


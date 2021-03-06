<?php
/**
 *
 * 『「重要な処理」の際に混入する脆弱性』（安全なWebアプリケーションの作り方 p141~）
 * パスワード変更処理を題材にして
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 15:03
 */

session_start();

function ex($s) { //XSS対策用のHTMLエスケープと表示関数
    echo htmlspecialchars($s, ENT_COMPAT, 'UTF-8');
}

session_start();
$data = $_SESSION['data'];
$pass  = @$_POST['pass'];
$passNum = strlen($pass);
$pass = md5($pass);

if (!$data || !$data['email'] || !$data['pass']) {
    die('ログインしてください');
}

/**
 * 新パスワード登録
 */

if (!$pass) {
    die('パスワードを4字以上で入力してください');
}

/* トランザクション開始 */
try {
    /* データベースに接続 */
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

    $pdo->beginTransaction();

    $sql = "UPDATE user_data SET pass = :pass WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $params = array(':pass' => $pass, ':email' => $data['email']);
    $stmt->execute($params);

    /* 変更をコミットする */
    $pdo->commit();

} catch (PDOException $e) {

    die($e->getMessage());

}

$data['pass'] = $pass;
$_SESSION['data'] = $data;

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

<h1>パスワード変更完了</h1>
<?php echo $data['name']; ?>さんのパスワードを変更しました。
<a href="top-page.php">ホームページに戻る</a>


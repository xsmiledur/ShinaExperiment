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
    die('ログイン失敗 ERROR1 再ログインは<a href="login.php">こちら</a>から');
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
            //PDO::ATTR_EMULATE_PREPARES => false
        ]
    );


    //一番やばいパターン(埋め込み)
    $sql = "SELECT * FROM user_data WHERE email = '" . $email . "' AND pass = '".$pass."';";
    //$sql = "SELECT * FROM user_data WHERE email = '$email' AND pass = '$pass';";
    $stmt = $pdo->query($sql);
    if ($stmt) {
        $res = $stmt->execute();
        $data = $stmt->fetch();
    }

    /*
    //プレースホルダ式
    $sql = "SELECT * FROM user_data WHERE email = :email AND pass = :pass;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $result = $stmt->execute();
    $data = $stmt->fetch();


    string(110) "SELECT * FROM user_data WHERE email = 'aaa' AND pass = '';SELECT * FROM user_data WHERE email = 'yuri@eee.jp';" bool(false) ログイン失敗 ERROR2 再ログインはこちらから

    */

} catch (PDOException $e) {

    die($e->getMessage());

}

if (!$data) {
    die('ログイン失敗 ERROR2 再ログインは<a href="login.php">こちら</a>から');
}

$_SESSION['data'] = $data;
$_SESSION['email'] = $email;
$_SESSION['pass'] = $pass;

/* もし遷移先があればリダイレクト */
$url = @$_GET['url'];
if ($url) {
    header('Location: '. $url);
} else {
    header('Location: top-page.php');
}
exit();


<?php
/**
 * auth.php
 * ログイン認証
 *
 * 『4.7.1 リダイレクト処理にまつわる脆弱性 オープンリダイレクタ脆弱性』（安全なWebアプリケーションの作り方 p187~）
 * リダイレクト処理
 *
 * オープンリダイレクタ脆弱性を悪用した典型的な攻撃パターン
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 15:03
 */

session_start();

$email = (@$_POST['email']) ? @$_POST['email'] : $_SESSION['email'];
$pass  = (@$_POST['pass']) ? @$_POST['pass'] : $_SESSION['pass'];
$pass = md5($pass);

$url = @$_GET['url'];
if ($url != "") $header = 'Location: '. $url;
else $header = 'Location: top-page.php';

if (!$email || !$pass) {
    $_SESSION['msg'] = "1文字以上記入してください。";
    header('Location: login.php?url='.$url);
    exit();
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
    $sql = "SELECT * FROM user_data WHERE pass = '$pass' AND email = '$email';";
    $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);
    if ($stmt) {
        $data = $stmt->fetch();
    } else {
        var_dump($pdo->errorInfo()[2]);
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
    $_SESSION['msg'] = "Emailまたはパスワードが違います。再度認証してください。";
    header('Location: login.php?url='.$url);
    exit();
}

$_SESSION['data'] = $data;

/* もし遷移先があればリダイレクト */
header($header);
exit();


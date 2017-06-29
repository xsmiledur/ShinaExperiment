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
 * *** 脆弱性をカバーしたページ ***
 *
 * ①リダイレクト先のURLを固定
 * // 柔軟性がないため、今回は使用しない
 * ②リダイレクト先のURLを直接指定せず番号指定にする
 * //
 * ③リダイレクト先のドメインをチェックする
 * // 今回はドメインがlocalhost:8081で共通なので対策のしようがない、省く
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
$url = intval($url);
if ($url != "" && is_int($url)) { //$url が数値だったら

    try {
        // データベースに接続
        $pdo = new PDO(
            'mysql:host=mydb;port=3306;charset=utf8;dbname=shina_exp;',
            'root',
            'password'
        );
        $sql = "SELECT ud_page FROM url_data WHERE ud_pid = :ud_pid;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ud_pid', $url, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt) {
            $url = $stmt->fetch(PDO::FETCH_ASSOC);
            $header = 'Location: ' . $url['ud_page'];
        } else {
            var_dump($pdo->errorInfo()[2]);exit();
        }
    } catch (PDOException $e) {
        die($e->getMessage());

    }
} else {
    $header = 'Location: top-page.php';
    }

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
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );


    //一番やばいパターン(埋め込み)
    $sql = "SELECT * FROM user_data WHERE email = '$email' AND pass = '$pass';";
    $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);
    if ($stmt) {
        $data = $stmt->fetch();
    } else {
        var_dump($pdo->errorInfo()[2]);
    }


    //プレースホルダ式
    $sql = "SELECT * FROM user_data WHERE email = :email AND pass = :pass;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    if ($stmt) {
        $stmt->execute();
        $data = $stmt->fetch();
    } else {
        var_dump($pdo->errorInfo()[2]);
    }


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


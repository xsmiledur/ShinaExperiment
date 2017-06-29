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
 * // 物品の購入において利用者の意思の念押し等に用いるので、今回は省く
 * ③Refererのチェック
 * // 前のページのチェック
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 15:03
 */

session_start();
$data = $_SESSION['data'];
$pass  = @$_POST['pass'];
$passNum = strlen($pass);
$pass = md5($pass);

// ログイン必須
if (!$data || !$data['email'] || !$data['pass']) {
    die('ログインしてください');
}

// ①秘密情報Token 確認
// 第三者に予測不可能なトークンを要求することにより、CSRF攻撃を防ぐことができる
if (session_id() != @$_POST['token']) {
    die('正規の画面からご使用ください[TOKEN]');
}

// ③Refererのチェック
if (preg_match('#\Ahttp://localhost/correct/pass-change.php#', @$_SERVER['HTTP_REFERER']) !== 1) {
    die('正規の画面からご使用ください[REFERER]');
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


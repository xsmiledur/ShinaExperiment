<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/22
 * Time: 13:11
 */

session_start();

$data = $_SESSION['data'];
$id = $_SESSION['id'];
if (!$data || !$data['email'] || !$data['pass']) header('Location: index.php');

$update = $_SESSION['update'];
$update['id'] = $id;

$update_ = array();
foreach ($update as $name => $item) {
    $update_[':'.$name] = $item;
}
$update['pass'] = $data['pass'];

try {

    // データベースに接続
    $pdo = new PDO(
        'mysql:host=mydb;port=3306;charset=utf8;dbname=shina_exp;',
        'root',
        'password',
        [
            //PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/mysql/my.cnf',
            //PDO::MYSQL_ATTR_READ_DEFAULT_GROUP => 'client',
            PDO::ATTR_EMULATE_PREPARES => false //ここをfalseにしないとSQLインジェクションが起こる
        ]
    );
    $sql = "UPDATE user_data SET email = :email, name = :name, sex = :sex, age = :age, univ = :univ, birth = :birth WHERE id = :id";
    $stmt = $pdo -> prepare($sql);
    if ($stmt) {
        $res = $stmt->execute($update_);
        if ($res) {
            $_SESSION['data'] = $update;
            die('変更しました。トップページは<a href="top-page.php">こちら</a>から');
        } else {
            die('変更に失敗しました。');
        }
    } else {
        var_dump($pdo->errorInfo()[2]);

    }



} catch (PDOException $e) {

    die($e->getMessage());

}

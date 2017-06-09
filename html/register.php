<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 14:55
 */

$name  = @$_POST['name'];
$email = @$_POST['email'];
$pass  = @$_POST['pass'];
$age   = @$_POST['age'];
$sex   = @$_POST['sex'];
$birth = @$_POST['birth'];
$univ  = @$_POST['univ'];

try {

    // データベースに接続
    $pdo = new PDO(
        'mysql:host=mydb;port=3306;charset=utf8;unix_socket=/var/run/mysqld/mysqld.sock;', 'root', 'password'
/*        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
*/
    );

    $stmt = $pdo->prepare('SELECT * FROM tbl WHERE id = :id');
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $result = $stmt->execute();


} catch (PDOException $e) {

    die($e->getMessage());

}
<?php
/**
 *
 * ②SQL呼び出しに伴う脆弱性（安全なWebアプリケーションの作り方 p123~）
 *
 * 脆弱なサイト（SQLインジェクション攻撃によるデータ改ざん）
 *
 * 1;delete from user_data
 *
 * などと打つと全ての蔵書の著者がcracked!になったり
 * （！PDOのコメントアウトをするのを忘れずに）
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 16:01
 */


$age = $_GET['age'];

try {
    // データベースに接続
    $pdo = new PDO(
        'mysql:host=mydb;port=3306;charset=utf8;dbname=shina_exp;',
        'root',
        'password',
        [
            //PDO::MYSQL_ATTR_READ_DEFAULT_FILE => '/etc/mysql/my.cnf',
            //PDO::MYSQL_ATTR_READ_DEFAULT_GROUP => 'client',
            //PDO::ATTR_EMULATE_PREPARES => false //ここをfalseにしないとSQLインジェクションが起こる
        ]
    );
    /*
    $sql = "SELECT * FROM user_data WHERE (email = '" . $email . "' AND pass = '".$pass."');";
    $data = $pdo->query($sql);
    var_dump($data);
    echo "<br><br>";
    */

    if ($age) {
        $sql = "SELECT * FROM user_data WHERE age >= " . $age . ";";
    } else {
        $sql = "SELECT * FROM user_data ORDER BY id;";
    }
    $stmt = $pdo->query($sql);
    if ($stmt) {
        $res = $stmt->execute();
        $data = $stmt->fetchAll();
    }
    //$data = $stmt->fetchAll();
    /*
        var_dump($sql);
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
        $data = $stmt->fetchAll();
    */


} catch (PDOException $e) {

    die($e->getMessage());

}



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>蔵書検索</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>ユーザ検索</h1>
検索キーワード：<?php echo ($age) ? $age : "なし"; ?>

<form action="" method="GET">
    年齢で検索できます
    <input type="text" name="age"> 歳以上のユーザを
    <button type="submit">検索</button>
</form>


<?php if ($data) : ?>
    <table>
        <thead>
        <tr>
            <th>名前</th>
            <th>年齢</th>
            <th>性別</th>
            <th>誕生日</th>
            <th>出身大学</th>
        </tr>
        </thead>
        <?php foreach($data as $item) : ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['age']; ?></td>
                <td><?php echo $item['sex']; ?></td>
                <td><?php echo $item['birth']; ?></td>
                <td><?php echo $item['univ']; ?></td>
            </tr>

        <?php endforeach; ?>

    </table>
<?php else: ?>
    お探しの条件では結果はありません。
<?php endif; ?>

<a href="auth.php">トップページに戻る</a>
</body>

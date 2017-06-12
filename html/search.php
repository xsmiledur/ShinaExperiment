<?php
/**
 *
 * ①『表示処理に伴う問題』（安全なWebアプリケーションの作り方 p88~）
 * XSSによるクッキー値の盗み出し
 *
 * 脆弱なサイト（Cookie値を盗み出すのに使われる）
 *
 * ②SQL呼び出しに伴う脆弱性（安全なWebアプリケーションの作り方 p123~）
 *
 * 脆弱なサイト（SQLインジェクション攻撃によるデータ改ざん）
 *
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 15:50
 */


$keyword = $_GET['keyword'];

if ($keyword) {
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

        $sql = "SELECT * FROM book_data WHERE author = '" . $keyword . "';";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
        $data = $stmt->fetch();


    } catch (PDOException $e) {

        die($e->getMessage());

    }

}


?>

<body>
検索キーワード：<?php echo $keyword; ?>

<form action="" method="GET">
    著者名で検索できます
    <input name="keyword">
</form>


<table>
    <thead>
    <tr>
        <th>蔵書ID</th>
        <th>タイトル</th>
        <th>著者名</th>
        <th>出版社</th>
        <th>出版年</th>
        <th>価格</th>
    </tr>
    </thead>
    <?php foreach($data as $item) : ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['title']; ?></td>
            <td><?php echo $item['author']; ?></td>
            <td><?php echo $item['company']; ?></td>
            <td><?php echo $item['year']; ?></td>
            <td><?php echo $item['value']; ?></td>
        </tr>

    <?php endforeach; ?>

</table>

</body>

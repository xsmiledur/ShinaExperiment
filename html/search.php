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
 * '; update book_data set title='cracked!
 * ';+update+book_data+set+title='cracke
 *
 * ' and cast((select id||':'||pass+from user_data offset 0 limit 1) as integer)>1
 * '; DELETE FROM book_data
 * '; update+book_data+set+title%3D'<i>cracked!</i>（URL攻撃の場合こっち）
 * などと打つと全ての蔵書の著者がcracked!になったり
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 15:50
 */


session_start();
$data = $_SESSION['data'];

if (!$data || !$data['email'] || !$data['pass']) {
    header('Location: index.php');
}

$keyword = $_GET['keyword'];

try {
    // データベースに接続
    $pdo = new PDO(
        'mysql:host=mydb;port=3306;charset=utf8;dbname=shina_exp;',
        'root',
        'password'
    );
    //$sql = "SELECT * FROM user_data WHERE author = :author;";
    /*
    $data = $pdo->query($sql);
    var_dump($data);
    echo "<br><br>";
    */

    if ($keyword) {
        $sql = "SELECT * FROM book_data WHERE author = '" . $keyword . "' ORDER BY id;";
        $sql = "SELECT * FROM book_data WHERE author = '" . $keyword . "';";
    } else {
        $sql = "SELECT * FROM book_data ORDER BY id;";
    }

    $stmt = $pdo->query($sql, PDO::FETCH_ASSOC);
    if ($stmt) {
        $data = $stmt->fetchAll();
    } else {
        var_dump($pdo->errorInfo()[2]);
    }
    //var_dump($stmt);
    //var_dump($data);
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
<h1>蔵書検索</h1>
検索キーワード：<?php echo ($keyword) ? $keyword : "なし"; ?>

<form action="" method="GET">
    著者名で検索できます
    <input name="keyword">
    <button type="submit">検索</button>
</form>


<?php if ($data) : ?>
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
    <?php foreach ($data as $item) : ?>
        <tr>
            <?php foreach ($item as $item2) : ?>
            <td><?php echo $item2; ?></td>
            <?php endforeach; ?>
        </tr>

    <?php endforeach; ?>

</table>
<?php else: ?>
    お探しの条件では結果はありません。
<?php endif; ?>

<a href="top-page.php">トップページに戻る</a>

<!--<script type="text/javascript">alert(navigator.cookieEnabled);</script>-->
<!--<script type="text/javascript"> alert(document.cookie);</script>-->
<!--<script type="text/javascript">alert("aaa");</script>-->

</body>

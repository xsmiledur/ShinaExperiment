<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 14:49
 */

$clm = array('name', 'email', 'pass', 'age', 'sex', 'birth', 'univ');

$data = array();
foreach ($clm as $name) {
    if ($name != "pass") $data[$name] = @$_POST[$name];
    else {
        $data[$name] = @$_POST[$name];
        $passNum = strlen($data[$name]);
        $data[$name] = md5($data[$name]); //ハッシュ化する
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>確認ページ</h1>


<form action="register.php" method="POST">
    <table>
        <thead>
        <tr>
            <th>項目名</th>
            <th>フォーム</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>名前</th>
            <td><?php echo $data['name']; ?></td>
            <input type="hidden" name="name" value="<?php echo $data['name']; ?>">
        </tr>
        <tr>
            <th>Emailアドレス</th>
            <td><?php echo $data['email']; ?></td>
            <input type="hidden" name="email" value="<?php echo $data['email']; ?>">
        </tr>
        <tr>
            <th>パスワード</th>
            <td><?php echo str_repeat ("●", $passNum ); ?></td>
            <input type="hidden" name="pass" value="<?php echo $data['pass']; ?>">
        </tr>
        <tr>
            <th>年齢</th>
            <td><?php echo $data['age']; ?></td>
            <input type="hidden" name="age" value="<?php echo $data['age']; ?>">
        </tr>
        <tr>
            <th>性別</th>
            <input type="hidden" name="sex" value="<?php echo $data['sex']; ?>">
            <td><?php echo $data['sex']; ?></td>
        </tr>
        <tr>
            <th>誕生日</th>
            <td><?php echo $data['birth']; ?></td>
            <input type="hidden" name="birth" value="<?php echo $data['birth']; ?>">
        </tr>
        <tr>
            <th>出身大学</th>
            <td><?php echo $data['univ']; ?></td>
            <input type="hidden" name="univ" value="<?php echo $data['univ']; ?>">
        </tr>
        </tbody>
    </table>
    <button type="submit">登録</button>
</form>

<a href="signup.php">訂正する</a>
<a href="/">戻る</a>

</body>
</html>

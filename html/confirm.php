<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/09
 * Time: 14:49
 */
$name  = @$_POST['name'];
$email = @$_POST['email'];
$pass  = @$_POST['pass'];
$age   = @$_POST['age'];
$sex   = @$_POST['sex'];
$birth = @$_POST['birth'];
$univ  = @$_POST['univ'];

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
            <td><?php echo $name; ?></td>
            <input type="hidden" name="name" value="<?php echo $name; ?>">
        </tr>
        <tr>
            <th>Emailアドレス</th>
            <td><?php echo $email; ?></td>
            <input type="hidden" name="email" value="<?php echo $email; ?>">
        </tr>
        <tr>
            <th>パスワード</th>
            <td><?php echo $pass; ?></td>
            <input type="hidden" name="pass" value="<?php echo $pass; ?>">
        </tr>
        <tr>
            <th>年齢</th>
            <td><?php echo $age; ?></td>
            <input type="hidden" name="age" value="<?php echo $age; ?>">
        </tr>
        <tr>
            <th>性別</th>
            <input type="hidden" name="sex" value="<?php echo $sex; ?>">
            <td><?php echo $sex; ?></td>
        </tr>
        <tr>
            <th>誕生日</th>
            <td><?php echo $birth; ?></td>
            <input type="hidden" name="birth" value="<?php echo $birth; ?>">
        </tr>
        <tr>
            <th>出身大学</th>
            <td><?php echo $univ; ?></td>
            <input type="hidden" name="univ" value="<?php echo $univ; ?>">
        </tr>
        </tbody>
    </table>
    <button type="submit">登録</button>
</form>

<a href="signup.php">訂正する</a>
<a href="/">戻る</a>

</body>
</html>

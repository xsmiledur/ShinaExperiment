<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/16
 * Time: 14:27
 */


session_start();
$data = $_SESSION['data'];

if (!$data || !$data['email'] || !$data['pass']) {
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
$to = "xsmiledur.8x7@gmail.com";
$subject = "【お問い合わせ】 ".$title;
$body = "以下の問い合わせがありましたので対応お願いします\n" . $body;
$headers = 'From: xsmiledur.8x7@gmail.com' . "\r\n";
$res = mb_send_mail($to, $subject, $body, $headers);

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
<a href="logout.php">ログアウト</a><br>
</body>
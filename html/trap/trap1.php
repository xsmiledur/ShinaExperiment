<?php
/**
 *
 *  * 『「重要な処理」の際に混入する脆弱性』（安全なWebアプリケーションの作り方 p141~）
 * パスワード変更処理を題材にして
 *
 * *** 罠ページ（このページに飛んでる時点で罠は踏んでる） ***
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 15:21
 */

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>罠ページその１</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>
激安商品情報
<iframe src="pass-change.php" style="width: 1000px; height: 200px; display: none;">
</iframe>
<img src="">
<br>

<a href="javascript:history.back();">戻る</a>
<a href="top-page.php">トップページへ</a>
<a href="../logout.php">ログアウト</a><br>
</body>
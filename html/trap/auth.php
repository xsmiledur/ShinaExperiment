<?php
/**
 * Created by IntelliJ IDEA.
 * User: xsmiledur
 * Date: 2017/06/12
 * Time: 17:03
 */

$email = @$_POST['email'];
$pass = @$_POST['pass'];

//ここでemailでデータを受け取ったりする

header('Location: /search.php');
exit();
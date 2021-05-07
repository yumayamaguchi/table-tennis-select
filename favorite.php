<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //最後のログインから1時間有効
    $_SESSION['time'] = time();

    $sql = $db->prepare('INSERT INTO favorite SET member_id=?, tool_number=?, created=NOW()');
    $sql->execute(array($_SESSION['id'], $_SESSION['number']));
    
    //元ページの取得
    $url = parse_url($_SERVER['HTTP_REFERER']);
    $_SESSION['paths'] = $url['path'];

    header('Location:'. $_SESSION['paths']);
    exit();
} else {
    header('Location: login.php');
    exit();
}

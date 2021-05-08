<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //最後のログインから1時間有効
    $_SESSION['time'] = time();
    $url = parse_url($_SERVER['HTTP_REFERER']);
    $_SESSION['paths'] = $url['path'];

    $favorite = $db->prepare('SELECT COUNT(*) AS cnt FROM favorite WHERE member_id=? AND tool_number=?');
    $favorite->execute(array($_SESSION['id'], $_SESSION['number']));
    $record = $favorite->fetch();

    if($record['cnt'] > 0) {
        header('Location:'. $_SESSION['path'] .'?record=duplicate');
        exit();
    } else {

    $sql = $db->prepare('INSERT INTO favorite SET member_id=?, tool_number=?, created=NOW()');
    $sql->execute(array($_SESSION['id'], $_SESSION['number']));

    //元ページの取得
    header('Location:' . $_SESSION['paths']. '?record=success');
    exit();
    }
} else {
    header('Location: login.php');
    exit();
}

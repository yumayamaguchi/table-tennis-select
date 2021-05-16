<?php
session_start();
require('dbconnect.php');



if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //最後のログインから1時間有効
    $_SESSION['time'] = time();
    $url = parse_url($_SERVER['HTTP_REFERER']);


    $favorite = $db->prepare('SELECT COUNT(*) AS cnt FROM favorites WHERE member_id=? AND racket_rubber_choice=? AND racket_rubber_id=?');
    $favorite->execute(array($_SESSION['id'], $_REQUEST['racket_rubber'], $_REQUEST['id']));
    $record = $favorite->fetch();

    if($record['cnt'] > 0) {
        header('Location:'. $url['path'] .'?id='. $_REQUEST['id']. '&record=duplicate');
        exit();
    } else {

        $sql = $db->prepare('INSERT INTO favorites SET member_id=?, racket_rubber_choice=?, racket_rubber_id=?, created_at=NOW()');
        $sql->execute(array($_SESSION['id'], $_REQUEST['racket_rubber'], $_REQUEST['id']));

        //元ページの取得
        header('Location:' . $url['path']. '?id='. $_REQUEST['id']. '&record=success');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

?>

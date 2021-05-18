<?php
session_start();
require('dbconnect.php');

if($_REQUEST) {
    $id = $_REQUEST['id'];
}

if (isset($_SESSION['id'])) {
    $number = $_REQUEST['number'];

    $messages = $db->prepare('SELECT * FROM posts WHERE id=?');
    $messages->execute(array($number));
    $message = $messages->fetch();

    if ($message['member_id'] == $_SESSION['id']) {
        $del = $db->prepare('DELETE FROM posts WHERE id=?');
        $del->execute(array($number));
    }
}
$url = parse_url($_SERVER['HTTP_REFERER']);
$_SESSION['paths'] = $url['path'];
header('Location:' .$_SESSION['paths']. '?id='.$id);
exit();

?>
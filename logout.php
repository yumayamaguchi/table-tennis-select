<?php
session_start();
ini_set('display_errors', "On");
//セッションの中身を空にする
$_SESSION = array();
if(ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name() . '', time() - 42000,
    $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
session_destroy();

setcookie('email', '', time()-3600);

header('Location: index.php');
exit();
?>

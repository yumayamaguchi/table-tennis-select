<?php
try {
    $db = new PDO('mysql:dbname=heroku_4db747f7713360b;host=us-cdbr-east-04.cleardb.com;charset=utf8','ba3aa41d627faa','792de597');
} catch(PDOException $e) {
    print('DB接続エラー：' . $e->getMessage());
}
?>

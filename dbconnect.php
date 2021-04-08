<?php
try {
    $db = new PDO('mysql:dbname=table_tennis_tool;host=localhost;charset=utf8','root','root');
} catch(PDOException $e) {
    print('DB接続エラー：' . $e->getMessage());
}
?>
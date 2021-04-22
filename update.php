<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<link rel="stylesheet" href="style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>会員登録</h1>
</div>
<?php
session_start();
require('dbconnect.php');

$id = $_SESSION['id'];
$statement = $db->prepare('UPDATE members SET name=?, email=?, password=? WHERE id=?');
$statement->execute(array($_POST['name'], $_POST['email'], sha1($_POST['new_pass']), $id));
?>


<div id="content">
<p>登録内容を変更しました</p>
<p><a href="login.php">ログインする</a></p>
</div>

</div>
</body>
</html>
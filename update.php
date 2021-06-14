<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">

	<title>会員登録</title>

	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<?php require('./header.php') ?>
	</header>
	<div class="content">
		<div class="entry">
			<div id="head">
				<h1>会員登録</h1>
			</div>
			<?php
			session_start();
			require('dbconnect.php');

			$id = $_SESSION['id'];
			$name = $_SESSION['join']['name'];
			$email = $_SESSION['join']['email'];
			$new_pass = $_SESSION['join']['new-pass'];
			$statement = $db->prepare('UPDATE members SET name=?, email=?, password=? WHERE id=?');
			$statement->execute(array($name, $email, sha1($new_pass), $id));
			?>


			<div id="content">
				<p><?php print($_POST['name']); ?>登録内容を変更しました</p>
				<p><a class="btn btn-primary" href="login.php">ログインする</a></p>
			</div>

		</div>
	</div>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>

</html>

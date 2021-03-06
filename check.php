<!-- 新規会員登録確認画面 -->

<?php
session_start();
require('./dbconnect.php');

if (!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, created_at=NOW()');
    echo $statement->execute(array($_SESSION['join']['name'], $_SESSION['join']['email'], sha1($_SESSION['join']['password'])));
    unset($_SESSION['join']);

    header('Location: thanks.php');
    exit();
}

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>会員登録</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
    <header>
    <?php require('./header.php')?>
    </header>
    <div class="content">
        <p class="new">確認画面</p>
        <div class="entry">
            <form action="" method="POST">
                <input type="hidden" name="action" value="submit">
                <div class="type">
                    <div>
                        <p class="title">ニックネーム</p>
                        <p><?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?></p>
                    </div>
                    <div>
                        <p class="title">メールアドレス</p>
                        <p><?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?></p>
                    </div>
                    <div>
                        <p class="title">パスワード</p>
                        <p>表示されません</p>
                    </div>
                </div>
                <div class="submit">
                    <div class="bt"><input type="button" onclick="location.href='create.php?action=rewrite'" value="書き直す"><input type="submit" value="登録する" /></div>
                </div>
            </form>
        </div>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>

</html>
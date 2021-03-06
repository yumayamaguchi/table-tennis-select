<!-- 新規会員登録画面 -->

<?php
session_start();
require('./dbconnect.php');
if (!empty($_POST)) {

   $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

    if (!preg_match($pattern, $_POST['email'])) {
        $error['email'] = 'mismatch';
    }
    if ($_POST['name'] === '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }


    // アカウントの重複チェック
    if(empty($error)) {
        $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
        $member->execute(array($_POST['email']));
        $record = $member->fetch();
        if($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    } 


    if (empty($error)) {
        $_SESSION['join'] = $_POST;
        header('Location: check.php');
        exit();
    }
}

if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
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
</head>

<body>
    <header>
    <?php require('./header.php')?>
    </header>
    <div class="content">

        <p class="new">新規会員登録</p>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="entry">
                <div class="type">
                    <div>
                        <p class="title">ニックネーム</p>
                        <input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>" placeholder="" />
                        <?php if ($error['name'] === 'blank') : ?>
                            <p class="error">ニックネームを入力してください</p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="title">メールアドレス</p>
                        <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>" placeholder="xxx@example.com">
                        <?php if ($error['email'] === 'mismatch') : ?>
                            <p class="error">メールアドレスの形式が正しくありません</p>
                        <?php endif; ?>
                        <?php if ($error['email'] === 'blank') : ?>
                            <p class="error">メールアドレスを入力してください</p>
                        <?php endif; ?>
                        <?php if ($error['email'] === 'duplicate') : ?>
                            <p class="error">指定されたメールアドレスは、すでに登録されています。</p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="title">パスワード</p>
                        <input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>" placeholder="4文字以上" />
                        <?php if ($error['password'] === 'length') : ?>
                            <p class="error">パスワードは4文字以上で入力してください。</p>
                        <?php endif; ?>
                        <?php if ($error['password'] === 'blank') : ?>
                            <p class="error">パスワードを入力してください</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="submit">
                    <input type="submit" value="入力内容を確認する" />
                </div>
            </div>
        </form>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>

</html>
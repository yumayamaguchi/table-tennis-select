<?php
session_start();
if (!empty($_POST)) {
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
    $filename = $_FILES['image']['name'];
    if (!empty($filename)) {
        $ext = substr($filename, -3);
        if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
            $error['image'] = 'type';
        }
    }
    if (empty($error)) {
        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'member_picture/' . $image);
        $_SESSION['join'] = $_POST;
        $_SESSION['join']['image'] = $image;
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
</head>

<body>
    <header class="create_head">
        <div class="container-fluid">
            <div class="row">
                <div class="head col-md-6">
                    <p><a href="index.php">卓球ツール</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <li>会員登録</li>
                        <li>ログイン</li>
                    </ul>
                </div>
            </div>
        </div>
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
                            <?php if ($error['email'] === 'blank') : ?>
                                <p class="error">メールアドレスを入力してください</p>
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
                    <div>
                        <p class="title">写真など</p>
                        <input type="file" name="image" size="35" value="test" />
                        <?php if ($error['image'] === 'type') : ?>
                            <p class="error">写真などは「.gif」「.jpg」「.png」の画像を指定してください。</p>
                        <?php endif; ?>
                        <?php if (!empty($error)) : ?>
                            <p class="error">恐れ入りますが、画像を改めて指定してください。</p>
                        <?php endif; ?>
                    </div>
                    <div class="submit">
                        <input type="submit" value="入力内容を確認する" />
                    </div>
                </div>
            </form>
        
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
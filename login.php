<?php
session_start();
require('./dbconnect.php');

if ($_COOKIE['email'] !== '') {
    $email = $_COOKIE['email'];
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    if ($_POST['email'] === '') {
        $error['email'] = 'failed';
    }
    if ($_POST['password'] === '') {
        $error['password'] = 'failed';
    }

    // バリデーションに使う正規表現
    $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

    if (!preg_match($pattern, $_POST['email'])) {
        $error['match'] = 'failed';
    }

    if (empty($error)) {
        //prepareによる実行の準備、
        $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
        $login->execute(array($_POST['email'], sha1($_POST['password'])));
        //該当するデータを1行とってくる
        $member = $login->fetch();

        if ($member) {
            $_SESSION['id'] = $member['id'];
            $_SESSION['time'] = time();

            if ($_POST['save'] === 'on') {
                setcookie('email', $_POST['email'], time()+60*60*24*14);
            }

            header('Location: index.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
    <title>ログインする</title>
</head>

<body>
    <header>
        <div class="container-fluid header">
            <div class="row">
                <div class="head col-md-6">
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="index.php">卓球ツール</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <li><a href="create.php">会員登録</a></li>
                        <li><a href="login.php">ログイン</a></li>
                        <li><a href="">ログアウト</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <p class="new">ログインする</p>
        <!-- <div id="lead">
                <p>メールアドレスとパスワードを記入してログインしてください。</p>
                <p>入会手続きがまだの方はこちらからどうぞ。</p>
                <p>&raquo;<a href="join/">入会手続きをする</a></p>
            </div> -->
        <form action="" method="post">
            <div class="entry">
                <div class="type">
                    <div>
                        <p class="title">メールアドレス</p>
                        <input type="text" name="email" size="35" maxlength="255" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>" />
                        <?php if ($error['email'] === 'failed') : ?>
                            <p class="error">メールアドレスをご記入ください</p>
                        <?php endif; ?>
                        <?php if ($error['match'] === 'failed') : ?>
                            <p class="error">メールアドレスの形式が正しくありません</p>
                        <?php endif; ?>
                        <?php if ($error['login'] === 'failed') : ?>
                            <p class="error">ログインに失敗しました。正しくご記入ください</p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <p class="title">パスワード</p>
                        <input type="password" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" />
                        <?php if ($error['password'] === 'failed') : ?>
                            <p class="error">パスワードをご記入ください</p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <p class="title">ログイン情報の記録
                    </div>
                    <input id="save" type="checkbox" name="save" value="on">
                    <label for="save">次回からは自動的にログインする</label>
                </div>
                <div>
                    <input type="submit" value="ログインする" />
                </div>
            </div>
    </div>
    </form>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>

</html>
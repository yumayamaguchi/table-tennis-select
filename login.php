<?php
session_start();
//DBへ接続
require('./dbconnect.php');


if($_REQUEST) {
    $id = $_REQUEST['id'];
}
//cookieにメールアドレスが入っていれば

if ($_COOKIE['email'] !== '') {
    $email = $_COOKIE['email'];
}

//post(formタグ)が空でなければ
if (!empty($_POST)) {
    //postに入力があれば上書き
    $email = $_POST['email'];

    // バリデーションに使う正規表現
    $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

    if (!preg_match($pattern, $_POST['email'])) {
        $error['email'] = 'mismatch';
    }
    //メールアドレスが空であれば、エラー
    if ($_POST['email'] === '') {
        $error['email'] = 'failed';
    }
    //passが空であれば、エラー
    if ($_POST['password'] === '') {
        $error['password'] = 'failed';
    }

    // バリデーションに使う正規表現

    if (empty($error)) {
        //prepareによる実行の準備、
        $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
        $login->execute(array($_POST['email'], sha1($_POST['password'])));
        //該当するデータを1行とってくる
        $member = $login->fetch();

        //該当するデータが存在すればtrue
        if ($member) {

            //セッションにDBのIDを代入
            $_SESSION['id'] = $member['id'];
            //セッションに時間の代入
            $_SESSION['time'] = time();

            //自動的にログインするチェックマークがはいっていれば
            if ($_POST['save'] === 'on') {
                //クッキーにメールアドレスの保存
                setcookie('email', $_POST['email'], time() + 60 * 60 * 24 * 14);
            }

                header('Location:index.php');
                exit();
            
            //アドレス、パスの該当がなければ実行
        } else {
            $error['login'] = 'failed';
        }
    }
}
$url = parse_url($_SERVER['HTTP_REFERER']);
$_SESSION['path'] = $url['path'];




?>
<!DOCTYPE html>
<html>

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
            <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="./index.php">卓球セレクト</a></p>
        </div>
        <div class="head_1 col-md-6">
            <ul>
                <?php if ($login->name === 'success') : ?>
                    <li><a href="./logout.php">ログアウト</a>|</li>
                    <li><a href="./my-page/my-page.php">マイページ</a>|</li>
                    <li><?php print($member->name); ?>さん、こんにちは！</li>
                <?php else : ?>
                    <li><a href="./create.php">会員登録</a>|</li>
                    <li><a href="./login.php">ログイン</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
    </header>
    <div class="content">
        <p class="new">ログインする</p>

        <div class="entry">
            <form action="" method="post">
                <div class="type">
                    <div>
                        <p class="title">メールアドレス</p>
                        <input type="text" name="email" size="35" maxlength="255" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>" />
                        <?php if ($error['email'] === 'mismatch') : ?>
                            <p class="error">メールアドレスの形式が正しくありません</p>
                        <?php endif; ?>
                        <?php if ($error['email'] === 'failed') : ?>
                            <p class="error">メールアドレスをご記入ください</p>
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
            </form>

            <form class="guest" action="" method="post">
                <input type="hidden" name="email" value="guest@example.jp">
                <input type="hidden" name="password" value="guest">
                <input type="submit" value="ゲストログイン">
            </form>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</body>

</html>
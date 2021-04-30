<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //時間の上書き、最後のログインから1時間
    $_SESSION['time'] = time();

    $login['name'] = 'success';

    //ログインしているユーザーの情報を引き出す
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();

// エラーチェック

if (!empty($_POST)) {
    if ($_POST['name'] === '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }
    //文字数長さチェック
    if (strlen($_POST['new-pass']) < 4) {
        $error['new-pass'] = 'length';
    }
    if ($_POST['new-pass'] === '') {
        $error['new-pass'] = 'blank';
    }
    if (sha1($_POST['pass']) != $member['password']) {
        $error['pass'] = 'fail';
    }
    if ($_POST['pass'] === '') {
        $error['pass'] = 'blank';
    }

    if (empty($error)) {
        $_SESSION['join'] = $_POST;
        header('Location: ../update.php');
        exit();
    }
} 
} else {
    header('Location: ../login.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>racket</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
    <!-- headerここから -->
    <header>
        <div class="container-fluid header">
            <div class="row">
                <div class="head col-md-6">
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="../index.php">卓プロ</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <?php if ($login['name'] === 'success') : ?>
                            <li><a href="logout.php">ログアウト</a>|</li>
                            <li><a href="my-page.php">マイページ</a>|</li>
                            <li><?php print($member['name']); ?>さん、こんにちは！</li>
                        <?php else : ?>
                            <li><a href="create.php">会員登録</a>|</li>
                            <li><a href="login.php">ログイン</a>|</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="head_image mypage_head">
            <img src="../images/header_table_equipment_lg.jpg" alt="">
            <p>マイページ</p>
        </div>
    </header>
    <div id="center">
        <!-- ユーザー画像と名前 -->
        <!-- <ul class="tabs-menu">
            <img src="">
            <div class="user_name">ユーザーネーム</div>
            <li class="my_page"><a href=".tabs-1">トップ</a></li>
            <li class="my_page"><a href=".tabs-2">口コミ</a></li>
            <li class="my_page"><a href=".tabs-3">設定</a></li>
        </ul> -->
        <ul class="tabs-menu">
            <li class="tab tab-2"><a href="my-page.php">トップ</a></li>
            <li class="tab tab-2"><a href="my-page-word.php">口コミ</a></li>
            <li class="tab tab-1"><a href="my-page-set.php">設定</a></li>
        </ul>
        <div class="tabs-content my_page_1">
            <div class="tabs-3 setting">
                <div class="setting_1"><i class="fas fa-user-cog"></i>設定</div>
                <div class="setting_2">
                    <form action="" method="post">
                    <input type="hidden" name="action" value="submit" />
                        <div class="setting_3 row">
                            <label class="col-3">ニックネーム：</label>
                            <input class="form-control col-9" type="text" name="name" size="30" maxlength="30" value="<?php print(htmlspecialchars($member['name'])); ?>">
                            <?php if ($error['name'] === 'blank') : ?>
                                <p class="error">ニックネームを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="setting_3 row">
                            <label class="col-3">メールアドレス：</label>
                            <input class="form-control col-9" type="text" name="email" size="30" value="<?php print(htmlspecialchars($member['email'])); ?>">
                            <?php if ($error['email'] === 'blank') : ?>
                                <p class="error">メールアドレスを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="setting_3 row">
                            <label class="col-3">新しいパスワード：</label>
                            <input class="form-control col-9" type="password" name="new-pass">
                            <?php if ($error['new-pass'] === 'length') : ?>
                                <p class="error">パスワードは4文字以上で入力してください。</p>
                            <?php endif; ?>
                            <?php if ($error['new-pass'] === 'blank') : ?>
                                <p class="error">パスワードを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="setting_3 row">
                            <label class="col-3">現在のパスワード：</label>
                            <input class="form-control col-9" type="password" name="pass">
                            <?php if ($error['pass'] === 'fail') : ?>
                                <p class="error">パスワードに誤りがあります</p>
                            <?php endif; ?>
                            <?php if ($error['pass'] === 'blank') : ?>
                                <p class="error">パスワードを入力してください</p>
                            <?php endif; ?>
                        </div>
                        <div class="button">
                            <button class="btn btn-primary" type="submit">登録内容を変更する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- フッターここから -->
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <script type="text/javascript">
        const showTab = (selector) => {
            console.log(selector);

            // 一旦activeクラスの削除
            $('.tabs-menu > li').removeClass('active');

            $('.tabs-content > div').hide();

            //selectorに該当するものだけactive要素を追加
            $(`.tabs-menu a[href="${selector}"]`)
                .parent('li')
                .addClass('active');

            // selectorに該当するものだけを表示
            $(selector).show();
        };
        $('.tabs-menu a').on('click', (e) => {
            e.preventDefault();

            //クリックされたhref要素の取得
            const selector = $(e.target).attr('href');
            showTab(selector);
        });

        showTab('.tabs-1');
    </script> -->
</body>
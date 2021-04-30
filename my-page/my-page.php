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
} else {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>racket</title>
    <meta charset="utf-8">
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
            <li class="tab tab-1"><a href="my-page.php">トップ</a></li>
            <li class="tab tab-2"><a href="my-page-word.php">口コミ</a></li>
            <li class="tab tab-2"><a href="my-page-set.php">設定</a></li>
        </ul>
        <div class="tabs-content my_page_1">
            <div class="tabs-1">おおお</div>
            <div class="tabs-2">ｗｗｗ</div>
            <div class="tabs-3 setting">
                <div class="setting_1"><i class="fas fa-user-cog"></i>設定</div>
                <div class="setting_2">
                    <form action="update.php" method="post">
                        <div class="setting_3">
                            <label>ニックネーム</label>
                            <input type="text" name="name" value="<?php print(htmlspecialchars($member['name'])); ?>">
                        </div>
                        <div class="setting_3">
                            <label>メールアドレス</label>
                            <input type="text" name="email" value="<?php print(htmlspecialchars($member['email'])); ?>">
                        </div>
                        <div class="setting_3">
                            <label>新しいパスワード</label>
                            <input type="password" name="new-pass">
                        </div>
                        <div class="setting_3">
                            <label>現在のパスワード</label>
                            <input type="password" name="pass">
                        </div>
                    <div class="">
                        <button type="submit">登録内容を変更する</button>
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
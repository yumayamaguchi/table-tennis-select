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

    //ラケットのお気に入りを取得
    $favorites = $db->prepare('SELECT * FROM racket, favorite WHERE favorite.member_id=? AND tool_number = racket.number');
    $favorites->execute(array($_SESSION['id']));
    $favorite = $favorites->fetchAll();
    
    //ラバーのお気に入りを取得
    $favorites_r = $db->prepare('SELECT * FROM rubber, favorite WHERE favorite.member_id=? AND tool_number = rubber.number');
    $favorites_r->execute(array($_SESSION['id']));
    $favorite_r = $favorites_r->fetchAll();
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
                            <li><a href="../logout.php">ログアウト</a>|</li>
                            <li><a href="my-page.php">マイページ</a>|</li>
                            <li><?php print($member['name']); ?>さん、こんにちは！</li>
                        <?php else : ?>
                            <li><a href="../create.php">会員登録</a>|</li>
                            <li><a href="../login.php">ログイン</a>|</li>
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
            <?php foreach ($favorite as $racket) {
                print('<div class="images col-md-3">');
                print('<div class="image_1">');
                print('<a href="../racket/racket-' . $racket['number'] . '/racket_' . $racket['number'] . '.php?number=' . $racket['number'] . '">');
                print('<img src="../images/racket' . $racket['number'] . '.jpg" alt="' . $racket['name'] . '" height="230" width="230">');
                print('<div>' . $racket['name'] . '<br>価格：' . $racket['price'] . '円(税込)<br>反発性：' . $racket['repulsion'] . '<br>振動特性：' . $racket['vibration'] . '</div>');
                print('</a>');
                print('</div>');
                print('</div>');
            } ?>
            <?php foreach ($favorite_r as $rubber) {
                print('<div class="images col-md-3">');
                print('<div class="image_1">');
                print('<a href="../rubber/rubber-' . $rubber['number'] . '/rubber_' . $rubber['number'] . '.php?number=' . $rubber['number'] . '">');
                print('<img src="../images/racket' . $rubber['number'] . '.jpg" alt="' . $rubber['name'] . '" height="230" width="230">');
                print('<div>' . $rubber['name'] . '<br>価格：' . $rubber['price'] . '円(税込)<br>反発性：' . $rubber['repulsion'] . '<br>振動特性：' . $rubber['vibration'] . '</div>');
                print('</a>');
                print('</div>');
                print('</div>');
            } ?>
        </div>
    </div>
    <!-- フッターここから -->
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>
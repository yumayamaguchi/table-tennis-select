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
    $favorites = $db->prepare('SELECT * FROM rackets, favorites WHERE favorites.member_id=? AND racket_rubber_choice=1 AND racket_rubber_id = rackets.id');
    $favorites->execute(array($_SESSION['id']));
    $favorite = $favorites->fetchAll();

    //ラバーのお気に入りを取得
    $favorites_r = $db->prepare('SELECT * FROM rubbers, favorites WHERE favorites.member_id=? AND racket_rubber_choice=2 AND racket_rubber_id = rubbers.id');
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
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="../index.php">卓球セレクト</a></p>
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
        <ul class="tabs-menu">
            <li class="tab tab-1"><a href="my-page.php">お気に入り</a></li>
            <li class="tab tab-2"><a href="my-page-word.php">口コミ</a></li>
            <li class="tab tab-2"><a href="my-page-set.php">設定</a></li>
        </ul>
        <div class="tabs-content my_page_1 container-fluid">
            <div class="row">
            <?php foreach ($favorite as $racket) {

                print('<div class="images col-md-3">');
                print('<div class="image_1">');
                print('<a href="../racket/racket_detail.php?id=' . $racket['racket_rubber_id'] . '">');
                print('<img src="../images/racket-' . $racket['racket_rubber_id'] . '/racket1.jpg" alt="' . $racket['name'] . '" height="230" width="230">');
                print('<div>' . $racket['name'] . '<br>価格：' . $racket['price'] . '円(税込)<br>反発性：' . $racket['repulsion'] . '<br>振動特性：' . $racket['vibration'] . '</div>');
                print('</a>');
                print('</div>');
                print('</div>');
            } ?>
            </div>
            <div class="row">
            <?php foreach ($favorite_r as $rubber) {
                print('<div class="images col-md-3">');
                print('<div class="image_1">');
                print('<a href="../rubber/rubber-' . $rubber['id'] . '/rubber_' . $rubber['id'] . '.php?id=' . $rubber['id'] . '">');
                print('<img src="../images/racket' . $rubber['id'] . '.jpg" alt="' . $rubber['name'] . '" height="230" width="230">');
                print('<div>' . $rubber['name'] . '<br>価格：' . $rubber['price'] . '円(税込)<br>反発性：' . $rubber['repulsion'] . '<br>振動特性：' . $rubber['vibration'] . '</div>');
                print('</a>');
                print('</div>');
                print('</div>');
            } ?>
            </div>
        </div>
    </div>
    <!-- フッターここから -->
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>
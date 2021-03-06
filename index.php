<?php
session_start();
require('./dbconnect.php');
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //時間の上書き、最後のログインから1時間
    $_SESSION['time'] = time();

    $login['name'] = 'success';

    //ログインしているユーザーの情報を引き出す
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
}

if ($_POST['filter'] === 'price') {
    $sort = $db->query('SELECT * FROM rackets ORDER BY price DESC');
    $sorts = $sort->fetchAll();
} elseif ($_POST['filter'] === 'vibration') {
    $sort = $db->query('SELECT * FROM rackets ORDER BY vibration DESC');
    $sorts = $sort->fetchAll();
} elseif ($_POST['filter'] === 'repulsion') {
    $sort = $db->query('SELECT * FROM rackets ORDER BY repulsion DESC');
    $sorts = $sort->fetchAll();
} else {
    $sort = $db->query('SELECT * FROM rackets');
    $sorts = $sort->fetchAll();
};


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <title>racket</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
    <!-- headerここから -->
    <header>
        <?php require('./header.php') ?>
        </div>
        <div class="head_image">
            <img src="images/banner_category_blade.jpg" alt="racket">
        </div>
    </header>
    <!-- headerここまで -->
    <!-- main_barここから -->
    <div id="main_bar">
        <ul>
            <a class="index" href="index.php">
                <li>ラケット</li>
            </a>
            <a class="index_1" href="index_1.php">
                <li>ラバー</li>
            </a>
        </ul>
    </div>
    <!-- main_barここまで -->
    <!-- side_barここから -->
    <div>
        <div id="side_bar">
            <ul>
                <li class="racket_1"><a href=""><i class="far fa-check-circle"></i>攻撃用シェーク</a></li>|
                <li class="racket_2"><a href=""><i class="far fa-check-circle"></i>守備用シェーク</a></li>|
                <li class="racket_3"><a href=""><i class="far fa-check-circle"></i>合板シェーク</a></li>|
                <li class="racket_4"><a href=""><i class="far fa-check-circle"></i>日本式ペン</a></li>|
                <li class="racket_5"><a href=""><i class="far fa-check-circle"></i>中国式ペン</a></li>|
            </ul>
            <form method="post" action="">
                <select name="filter">
                    <option value="select">選択してください</option>
                    <option value="price">価格順</option>
                    <option value="repulsion">反発性順</option>
                    <option value="vibration">振動特性順</option>
                </select>
                <input type="submit" value="並び替え">
            </form>
        </div>
        <!-- side_barここまで -->
        <!-- main_visualここから -->
        <div id="center" class="main_visual container-fluid">

            <div class="products">
                <p class="rackets_1">攻撃用シェーク</p>
                <div class="row">
                    <!-- 1だと攻撃型、2は守備型のDBに変更 -->
                    <?php
                    foreach ($sorts as $racket) {
                        if ($racket['type_id'] != 1) {
                            continue;
                        }
                        require('racket.php');
                    } ?>
                </div>
            </div>
            <div class="products">
                <p class="rackets_2">守備用シェーク</p>
                <div class="row">
                    <?php
                    foreach ($sorts as $racket) {
                        if ($racket['type_id'] != 2) {
                            continue;
                        }
                        require('racket.php');
                    } ?>
                </div>
            </div>
            <div class="products">
                <p class="rackets_3">合板シェーク</p>
                <div class="row">
                    <?php
                    foreach ($sorts as $racket) {
                        if ($racket['type_id'] != 3) {
                            continue;
                        }
                        require('racket.php');
                    } ?>
                </div>
            </div>
            <div class="products">
                <p class="rackets_4">日本式ペン</p>
                <div class="row">
                    <?php
                    foreach ($sorts as $racket) {
                        if ($racket['type_id'] != 4) {
                            continue;
                        }
                        require('racket.php');
                    } ?>
                </div>
            </div>

            <div class="products">
                <p class="rackets_5">中国式ペン</p>
                <div class="row">
                    <?php
                    foreach ($sorts as $racket) {
                        if ($racket['type_id'] != 5) {
                            continue;
                        }
                        require('racket.php');
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- main_visualここまで -->
    <!-- フッターここから -->
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <!-- フッターここまで -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="main.js"></script>
</body>

</html>
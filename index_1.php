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
    $sort = $db->query('SELECT * FROM rubbers ORDER BY price DESC');
    $sorts = $sort->fetchAll();
} elseif ($_POST['filter'] === 'speed') {
    $sort = $db->query('SELECT * FROM rubbers ORDER BY speed DESC');
    $sorts = $sort->fetchAll();
} elseif ($_POST['filter'] === 'spin') {
    $sort = $db->query('SELECT * FROM rubbers ORDER BY spin DESC');
    $sorts = $sort->fetchAll();
} else {
    $sort = $db->query('SELECT * FROM rubbers');
    $sorts = $sort->fetchAll();
};


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <title>rubber</title>
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
        <div class="head_image_2">
            <img src="images/header_rubber_lg.jpg" alt="rubber" height="175px" width="750px">
            <p class="rubber">ラバー</p>
            <p class="rubbers">RUBBER</p>
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
                <li class="racket_1"><a href=""><i class="far fa-check-circle"></i>ハイテンション裏ラバー</a></li>|
                <li class="racket_2"><a href=""><i class="far fa-check-circle"></i>裏ラバー</a></li>|
                <li class="racket_3"><a href=""><i class="far fa-check-circle"></i>粘着性ラバー</a></li>|
            </ul>
            <form method="post" action="">
                <select name="filter">
                    <option value="select">選択してください</option>
                    <option value="price">価格順</option>
                    <option value="repulsion">スピード順</option>
                    <option value="vibration">スピン順</option>
                </select>
                <input type="submit" value="並び替え">
            </form>
        </div>
        <!-- side_barここまで -->
        <!-- main_visualここから -->
        <div id="center" class="main_visual container-fluid">

            <div class="products">
                <p class="rackets_1">ハイテンション裏ラバー</p>
                <div class="row">
                    <!-- 1だと攻撃型、2は守備型のDBに変更 -->
                    <?php
                    foreach ($sorts as $rubber) {
                        if ($rubber['type_id'] != 1) {
                            continue;
                        }
                        require('rubber.php');
                    } ?>
                </div>
            </div>
            <div class="products">
                <p class="rackets_2">裏ラバー</p>
                <div class="row">
                    <?php
                    foreach ($sorts as $rubber) {
                        if ($rubber['type_id'] != 2) {
                            continue;
                        }
                        require('rubber.php');
                    } ?>
                </div>
            </div>
            <div class="products">
                <p class="rackets_3">粘着性ラバー</p>
                <div class="row">
                    <?php
                    foreach ($sorts as $rubber) {
                        if ($rubber['type_id'] != 3) {
                            continue;
                        }
                        require('rubber.php');
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
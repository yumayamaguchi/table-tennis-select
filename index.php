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
    $sort = $db->query('SELECT * FROM racket ORDER BY price DESC');
    $sorts = $sort->fetchAll();
} elseif ($_POST['filter'] === 'vibration') {
    $sort = $db->query('SELECT * FROM racket ORDER BY vibration DESC');
    $sorts = $sort->fetchAll();
} elseif ($_POST['filter'] === 'repulsion') {
    $sort = $db->query('SELECT * FROM racket ORDER BY repulsion DESC');
    $sorts = $sort->fetchAll();
} else {
    $sort = $db->query('SELECT * FROM racket');
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
            <img src="images/banner_category_blade.jpg" alt="">
        </div>
    </header>
    <!-- headerここまで -->
    <!-- main_barここから -->
    <div id="main_bar">
        <ul>
            <a class="index" href="index.php">
                <li>ラケット</li>
            </a>
            <a id="index_1" href="index_1.html">
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
                    <?php
                    foreach ($sorts as $racket) {
                        if ($racket['number'] > 8) {
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
                        if ($racket['number'] < 9 || $racket['number'] > 10) {
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
                        if ($racket['number'] < 11 || $racket['number'] > 14) {
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
                        if ($racket['number'] < 15 || $racket['number'] > 18) {
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
                        if ($racket['number'] < 19) {
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

    <div id="product-template" style="display: none;">
        <div class="images-1">
            <div class="image_1">
                <a href="">
                    <img class="product-image" src="" alt="吉田海偉" height="230" width="230">
                    <p><span class="product-name"></span><br><span class="product-price"></span></p>
                </a>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="main.js"></script>
    <script type="text/javascript">
        //非同期通信
        rubber = document.getElementById('index_1');

        rubber.addEventListener('click', (e) => {
            e.preventDefault();
            var ajax = new XMLHttpRequest();
            ajax.open('GET', 'index_1.json', true);
            ajax.onload = function(e) {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        var json = ajax.responseText;
                        //jsonをjavascriptオブジェクトに変換
                        //html() html要素の上書き
                        $('#center').html(createListHtml(JSON.parse(json)));

                    }
                }
            };
            ajax.send(null);

        });

        function createListHtml(list) {

            var result = $('<div class="product-list">');
            for (var i = 0; i < list.length; i++) {
                //jsonの配列を代入
                var product = list[i];
                var element = $('#product-template').find('.images-1').clone();
                //.product-nameにjsonのnameを入力
                element.find('.product-name').text(product.name);
                element.find('.product-price').text(product.price);
                element.find('.product-image').attr('src', product.image);
                //選手の名前を追加
                result.append(element);
            }
            return result;
        }
    </script>
</body>

</html>
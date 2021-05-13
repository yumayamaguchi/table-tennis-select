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
    <?php require('./header.php')?>
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
            <a href="">
                <li>検索ツール</li>
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
        </div>
        <!-- side_barここまで -->
        <!-- main_visualここから -->
        <!-- main_visualここから -->
        <div id="center" class="main_visual container-fluid">
            <div class="products">
                <p class="rackets_1">ハイテンション裏ラバー</p>
                <div class="row">
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/06090.jpg" alt="テナジー19" height="230" width="230">
                                <div>テナジー19<br>円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/06040.jpg" alt="ディグニクス05" height="230" width="230">
                                <div>ディグニクス05<br>円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/06050.jpg" alt="ディグニクス80" height="230" width="230">
                                <div>ディグニクス80<br>円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/06060.jpg" alt="ディグニクス64" height="230" width="230">
                                <div>ディグニクス64<br>円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05800.jpg" alt="テナジー05" height="230" width="230">
                                <div>テナジー05<br>円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05930.jpg" alt="テナジー80" height="230" width="230">
                                <div>テナジー80<br>円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05820.jpg" alt="テナジー64" height="230" width="230">
                                <div>テナジー64<br>円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05810.jpg" alt="テナジー25" height="230" width="230">
                                <div>テナジー25<br>円(税込)</div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="products">
                <p class="rackets_2">裏ラバー</p>
                <div class="row">
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05050.jpg" alt="スレイバー" height="230" width="230">
                                <div>スレイバー<br>3,520円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05380.jpg" alt="スレイバーEL" height="230" width="230">
                                <div>スレイバーEL<br>3,520円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05540.jpg" alt="サフィーラ" height="230" width="230">
                                <div>サフィーラ<br>2,750円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05210.jpg" alt="フレクストラ" height="230" width="230">
                                <div>フレクストラ<br>2,200円(税込)</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="products">
                <p class="rackets_3">粘着性裏ラバー</p>
                <div class="row">
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/06080.jpg" alt="アイビス" height="230" width="230">
                                <div>アイビス<br>5,500円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05330.jpg" alt="タキファイア ドライブ" height="230" width="230">
                                <div>タキファイア ドライブ<br>3,300円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05410.jpg" alt="タキネス ドライブ" height="230" width="230">
                                <div>タキネス ドライブ<br>3,080円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/05450.jpg" alt="タキネス チョップ" height="230" width="230">
                                <div>タキネス チョップ<br>3,080円(税込)</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main_visualここまで -->
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
</body>

</html>
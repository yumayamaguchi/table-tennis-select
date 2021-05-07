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
        <div class="container-fluid header">
            <div class="row">
                <div class="head col-md-6">
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="index.php">卓プロ</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <?php if ($login['name'] === 'success') : ?>
                            <li><a href="logout.php">ログアウト</a>|</li>
                            <li><a href="./my-page/my-page.php">マイページ</a>|</li>
                            <li><?php print($member['name']); ?>さん、こんにちは！</li>
                        <?php else : ?>
                            <li><a href="create.php">会員登録</a>|</li>
                            <li><a href="login.php">ログイン</a>|</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
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
        <div id="center" class="main_visual container-fluid">

            <div class="products">
                <p class="rackets_1">攻撃用シェーク</p>
                <div class="row">
                    <?php foreach ($db->query('select * from tool') as $tool) {
                        if ($tool['number'] > 8) {
                            break;
                        }
                        
                        print('<div class="images col-md-3">');
                        print('<div class="image_1">');
                        print('<a href="./racket-' . $tool['number'] . '/racket_' . $tool['number'] . '.php?number='.$tool['number'].'">');
                        print('<img src="images/racket' . $tool['number'] . '.jpg" alt="' . $tool['name'] . '" height="230" width="230">');
                        print('<div>' . $tool['name'] . '<br>価格：' . $tool['price'] . '円(税込)<br>反発性：' . $tool['repulsion'] . '<br>振動特性：' . $tool['vibration'] . '</div>');
                        print('</a>');
                        print('</div>');
                        print('</div>');
                    } ?>

                    <!-- <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/37091.jpg" alt="オフチャロフ インナーフォース ALC" height="230" width="230">
                                <div>オフチャロフ インナーフォース ALC<br>19,800円(税込)</div>
                            </a>
                        </div>
                    </div>

                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/37121.jpg" alt="フランチスカ インナーフォース ZLC" height="230" width="230">
                                <div>フランチスカ インナーフォース ZLC<br>27,500円(税込)</div>
                            </a>
                        </div>
                    </div>

                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/35861.jpg" alt="ティモボル ALC" height="230" width="230">
                                <div>ティモボル ALC<br>19,800円(税込)</div>
                            </a>
                        </div>
                    </div>

                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/35831.jpg" alt="ティモボル ZLC" height="230" width="230">
                                <div>ティモボル ZLC<br>27,500円(税込)</div>
                            </a>
                        </div>
                    </div>

                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/35841.jpg" alt="ティモボル ZLF" height="230" width="230">
                                <div>ティモボル ZLF<br>22,000円(税込)</div>
                            </a>
                        </div>
                    </div>

                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/36601.jpg" alt="水谷隼 SUPER ZLC" height="230" width="230">
                                <div>水谷隼 SUPER ZLC<br>41,800円(税込)</div>
                            </a>
                        </div>
                    </div>

                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/36611.jpg" alt="水谷隼 ZLC" height="230" width="230">
                                <div>水谷隼 ZLC<br>27,500円(税込)</div>
                            </a>
                        </div>
                    </div> -->

                </div>
            </div>
            <div class="products">
                <p class="rackets_2">守備用シェーク</p>
                <div class="row">
                    <?php foreach ($db->query('select * from tool') as $tool) {
                        if($tool['number'] < 9) {
                            continue;
                        }
                        if($tool['number'] > 10) {
                            break;
                        }
                        print('<div class="images col-md-3">');
                        print('<div class="image_1">');
                        print('<a href="./racket-' . $tool['number'] . '/racket_' . $tool['number'] . '.php">');
                        print('<img src="images/racket' . $tool['number'] . '.jpg" alt="' . $tool['name'] . '" height="230" width="230">');
                        print('<div>' . $tool['name'] . '<br>価格：' . $tool['price'] . '円(税込)<br>反発性：' . $tool['repulsion'] . '<br>振動特性：' . $tool['vibration'] . '</div>');
                        print('</a>');
                        print('</div>');
                        print('</div>');
                    } ?>

                    <!-- <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/36691.jpg" alt="インナーシールド レイヤー ZLF" height="230" width="230">
                                <div>インナーシールド レイヤー ZLF<br>19,800円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/36961.jpg" alt="ダイオードＶ" height="230" width="230">
                                <div>ダイオードＶ<br>7,700円(税込)</div>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="products">
                <p class="rackets_3">合板シェーク</p>
                <div class="row">
                <?php foreach ($db->query('select * from tool') as $tool) {
                        if($tool['number'] < 11) {
                            continue;
                        }
                        if($tool['number'] > 14) {
                            break;
                        }
                        print('<div class="images col-md-3">');
                        print('<div class="image_1">');
                        print('<a href="./racket-' . $tool['number'] . '/racket_' . $tool['number'] . '.php">');
                        print('<img src="images/racket' . $tool['number'] . '.jpg" alt="' . $tool['name'] . '" height="230" width="230">');
                        print('<div>' . $tool['name'] . '<br>価格：' . $tool['price'] . '円(税込)<br>反発性：' . $tool['repulsion'] . '<br>振動特性：' . $tool['vibration'] . '</div>');
                        print('</a>');
                        print('</div>');
                        print('</div>');
                    } ?>
                    <!-- <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/37141.jpg" alt="メイス アドバンス" height="230" width="230">
                                <div>メイス アドバンス<br>6,270円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/36681.jpg" alt="SK7クラシック" height="230" width="230">
                                <div>SK7クラシック<br>7,480円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/30271.jpg" alt="コルベル" height="230" width="230">
                                <div>コルベル<br>6,050円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/36931.jpg" alt="ティモボルJ" height="230" width="230">
                                <div>ティモボルJ<br>5,280円(税込)</div>
                            </a>
                        </div>
                    </div> -->

                </div>
            </div>
            <div class="products">
                <p class="rackets_4">日本式ペン</p>
                <div class="row">
                <?php foreach ($db->query('select * from tool') as $tool) {
                        if($tool['number'] < 15) {
                            continue;
                        }
                        if($tool['number'] > 18) {
                            break;
                        }
                        print('<div class="images col-md-3">');
                        print('<div class="image_1">');
                        print('<a href="./racket-' . $tool['number'] . '/racket_' . $tool['number'] . '.php">');
                        print('<img src="images/racket' . $tool['number'] . '.jpg" alt="' . $tool['name'] . '" height="230" width="230">');
                        print('<div>' . $tool['name'] . '<br>価格：' . $tool['price'] . '円(税込)<br>反発性：' . $tool['repulsion'] . '<br>振動特性：' . $tool['vibration'] . '</div>');
                        print('</a>');
                        print('</div>');
                        print('</div>');
                    } ?>
                    <!-- <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/23930.jpg" alt="サイプレスG-MAX" height="230" width="230">
                                <div>サイプレスG-MAX<br>30,800円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/23960.jpg" alt="サイプレスV-MAX" height="230" width="230">
                                <div>サイプレスV-MAX<br>19,800円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/23950.jpg" alt="サイプレスT-MAX" height="230" width="230">
                                <div>サイプレスT-MAX<br>13,200円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/23820.jpg" alt="ハッドロウJPV - S" height="230" width="230">
                                <div>ハッドロウJPV - S<br>10,450円(税込)</div>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="products">
                <p class="rackets_5">中国式ペン</p>
                <div class="row">
                <?php foreach ($db->query('select * from tool') as $tool) {
                        if($tool['number'] < 19) {
                            continue;
                        }
                        print('<div class="images col-md-3">');
                        print('<div class="image_1">');
                        print('<a href="./racket-' . $tool['number'] . '/racket_' . $tool['number'] . '.php">');
                        print('<img src="images/racket' . $tool['number'] . '.jpg" alt="' . $tool['name'] . '" height="230" width="230">');
                        print('<div>' . $tool['name'] . '<br>価格：' . $tool['price'] . '円(税込)<br>反発性：' . $tool['repulsion'] . '<br>振動特性：' . $tool['vibration'] . '</div>');
                        print('</a>');
                        print('</div>');
                        print('</div>');
                    } ?>
                    <!-- <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/23990.jpg" alt="ティモボル CAF - CS" height="230" width="230">
                                <div>ティモボル CAF - CS<br>8,250円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/23920.jpg" alt="SKカーボン - CS" height="230" width="230">
                                <div>SKカーボン - CS<br>8,580円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/23910.jpg" alt="SK7クラシック - CS" height="230" width="230">
                                <div>SK7クラシック - CS<br>7,480円(税込)</div>
                            </a>
                        </div>
                    </div>
                    <div class="images col-md-3">
                        <div class="image_1">
                            <a href="">
                                <img src="images/21760.jpg" alt="吉田海偉" height="230" width="230">
                                <div>吉田海偉<br>6,820円(税込)</div>
                            </a>
                        </div>
                    </div> -->
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
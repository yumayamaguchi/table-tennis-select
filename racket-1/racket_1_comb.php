<?php
session_start();
require('../dbconnect.php');

$ruckets = $db->query('SELECT * FROM rucket WHERE number=1');
$rucket = $ruckets->fetch();
$number = $rucket['number'];
$name = $rucket['name'];
$price = $rucket['price'];
$repulsion = $rucket['repulsion'];
$vibration = $rucket['vibration'];

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <title>林昀儒 SUPER ZLC｜卓球製品情報｜バタフライ卓球用品</title>
</head>

<body>
    <header>
        <?php require('../header_1.php') ?>
        <div class="head_image_1">
            <p>林昀儒 SUPER ZLC</p>
        </div>
    </header>
    <div class="main_bar">
        <ul class="slick01">
            <li><img alt="画像1" src="../images/racket1.jpg" /></li>
            <li><img alt="画像2" src="../images/racket1-1.jpg" /></li>
            <li><img alt="画像3" src="../images/racket1-2.jpg" /></li>
            <li><img alt="画像3" src="../images/racket1-3.jpg" /></li>
            <li><img alt="画像3" src="../images/racket1-4.jpg" /></li>
        </ul>
    </div>
    <!-- <div class="side_bar">
    </div> -->

    <div id="center">
        <div class="version">
            <h3>林昀儒選手の使用モデル</h3>
            <p>
                カーボンとZLファイバーを高密度に編み込んだスーパーZLカーボン搭載ラケットは、打球の威力を引き出す弾みの良さと、広い高反発エリアによる安定性が特徴です。
                類いまれな打球感覚を持つ中華台北の新星・林昀儒選手は、高めの振動特性を持つ威力重視のこのラケットを駆使し、鋭いチキータや質の高いカウンターを生み出しています。グリップに採用された彼の好みのカラーと、名前の頭文字で構成されたウイングマークは、若さと将来の成功を感じさせます。
            </p>
        </div>
        <a href="../favorite.php">
            <div class="favorite btn btn-warning"><i class="far fa-star"></i><span>お気に入りに追加</span></div>
        </a>
        <ul class="tabs-menu">
            <li class="tab tab-2"><a href="racket_1.php?number=<?php print($number); ?>">性能</a></li>
            <li class="tab tab-2"><a href="racket_1_word.php?number=<?php print($number); ?>">口コミ</a></li>
            <li class="tab tab-1"><a href="racket_1_comb.php?number=<?php print($number); ?>">お勧め組み合わせラバー</a></li>
        </ul>
        <div class="tabs-content">
            <!-- 組み合わせ -->
            <div class="tabs-3">
                <div class="tabs-3-2">
                    <div class="tabs-3-1">
                        <img src="../images/racket<?php print($number); ?>.jpg" alt="<?php print($name); ?>" height="200" width="200">
                        <div><?php print($name); ?><br><?php print($price); ?>円（税込）<br>反発特性：<?php print($repulsion); ?><br>振動特性：<?php print($vibration); ?></div>
                    </div>
                    <div class="tabs-3-1">
                        <?php
                        $rubbers = $db->query('SELECT * FROM rubber WHERE number=50');
                        $rubber = $rubbers->fetch();

                        print('<img src="../images/rubber' . $rubber['number'] . '.jpg" alt="' . $rubber['name'] . '" height="200" width="200">');
                        print('<div>' . $rubber['name'] . '<br>' . $rubber['price'] . '円(税込)<br>スピード：' . $rubber['speed'] . '<br>スピン：' . $rubber['spin'] . '</div>');
                        ?>
                    </div>
                    <div class="tabs-3-1">
                        <?php
                        $rubbers = $db->query('SELECT * FROM rubber WHERE number=51');
                        $rubber = $rubbers->fetch();

                        print('<img src="../images/rubber' . $rubber['number'] . '.jpg" alt="' . $rubber['name'] . '" height="200" width="200">');
                        print('<div>' . $rubber['name'] . '<br>' . $rubber['price'] . '円(税込)<br>スピード：' . $rubber['speed'] . '<br>スピン：' . $rubber['spin'] . '</div>');
                        ?>
                    </div>
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div>
                    <div class="tabs-3-1">
                        <img src="../images/37131.jpg" alt="林昀儒 SUPER ZLC" height="200" width="200">
                        <div>林昀儒 SUPER ZLC<br>41,800円(税込)</div>
                    </div>
                    <div class="tabs-3-1">
                        <img src="../images/06090.jpg" alt="テナジー19" height="200" width="200">
                        <div>テナジー19<br>円(税込)</div>
                    </div>
                    <div class="tabs-3-1">
                        <img src="../images/05810.jpg" alt="テナジー25" height="200" width="200">
                        <div>テナジー25<br>円(税込)</div>
                    </div>
                    <div class="chart">
                        <canvas id="myChart-1"></canvas>
                    </div>
                </div>
            </div>
            <!-- 組み合わせここまで -->
        </div>
    </div>
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../jquery.raty.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js" integrity="sha512-RGbSeD/jDcZBWNsI1VCvdjcDULuSfWTtIva2ek5FtteXeSjLfXac4kqkDRHVGf1TwsXCAqPTF7/EYITD0/CTqw==" crossorigin="anonymous"></script>
    <script src="../main.js"></script>
</body>

</html>
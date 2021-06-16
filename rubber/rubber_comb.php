<?php
session_start();
require('../dbconnect.php');
ini_set('display_errors', "On");

//フォア側のラバーの情報取得
$rubbers = $db->prepare('SELECT * FROM rackets_rubbers, rubbers WHERE rubber_four_id=? AND rubber_four_id=rubbers.id');
$rubbers->execute(array($_REQUEST['id']));
$rubber = $rubbers->fetch();
$id = $rubber['id'];
$name = $rubber['name'];

//バック側のラバーの情報取得
$rubbers_back = $db->prepare('SELECT * FROM rackets_rubbers, rubbers WHERE rubber_four_id=? AND rubber_back_id=rubbers.id');
$rubbers_back->execute(array($_REQUEST['id']));
$rubber_back = $rubbers_back->fetch();

//ラケットの情報取得
$rackets_rubbers = $db->prepare('SELECT * FROM rackets_rubbers, rackets WHERE rubber_four_id=? AND racket_id=rackets.id');
$rackets_rubbers->execute(array($_REQUEST['id']));
$racket_rubber = $rackets_rubbers->fetch();

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
    <title><?php print($name); ?></title>
</head>

<body>
    <header>
        <?php require('../header_1.php') ?>
        <div class="head_image_1">
            <p><?php print($name); ?></p>
        </div>
    </header>
    <div class="main_bar">
        <ul class="slick01">
            <li><img alt="画像1" src="../images/rubber-<?php print($id); ?>/rubber1.jpg" /></li>
            <li><img alt="画像2" src="../images/rubber-<?php print($id); ?>/rubber2.jpg" /></li>
            <li><img alt="画像3" src="../images/rubber-<?php print($id); ?>/rubber3.jpg" /></li>
        </ul>
    </div>
    <div id="center">
        <a href="../favorite.php?racket_rubber=1&id=<?php print($id); ?>">
            <div class="favorite btn btn-warning"><i class="far fa-star"></i><span>お気に入りに追加</span></div>
        </a>
        <?php if ($_REQUEST['record'] == 'duplicate') : ?>
            <div class="favorites">
                <p>すでにお気に入り登録済です！</p>
            </div>
        <?php elseif ($_REQUEST['record'] == 'success') : ?>
            <div class="favorites">
                <p>お気に入りに登録しました！</p>
                <?php ini_set('display_errors', "On"); ?>
            </div>
        <?php endif; ?>
        <ul class="tabs-menu">
            <li class="tab tab-2"><a href="rubber_detail.php?id=<?php print($id); ?>">性能</a></li>
            <li class="tab tab-2"><a href="rubber_word.php?id=<?php print($id); ?>">口コミ</a></li>
            <li class="tab tab-1"><a href="rubber_comb.php?id=<?php print($id); ?>">お勧め組み合わせラバー</a></li>
        </ul>
        <div class="tabs-content">
            <!-- 組み合わせ -->
            <div class="tabs-3">
                <div class="tabs-3-2">
                    <div class="tabs-3-1">
                        <img src="../images/racket-<?php print($racket_rubber['racket_id']); ?>/racket1.jpg" alt="<?php print($racket_rubber['racket_id']); ?>" height="200" width="200">
                        <div><?php print($racket_rubber['name']); ?><br><?php print($racket_rubber['price']); ?>円（税込）<br>反発特性：<?php print($racket_rubber['repulsion']); ?><br>振動特性：<?php print($racket_rubber['vibration']); ?></div>
                    </div>
                    <div class="tabs-3-1">
                        <?php
                        print('<img src="../images/rubber-' . $rubber['rubber_four_id'] . '/rubber1.jpg" alt="' . $rubber['name'] . '" height="200" width="200">');
                        print('<div>' . $rubber['name'] . '<br>' . $rubber['price'] . '円(税込)<br>スピード：' . $rubber['speed'] . '<br>スピン：' . $rubber['spin'] . '</div>');
                        ?>
                    </div>
                    <div class="tabs-3-1">
                        <?php
                        print('<img src="../images/rubber-' . $rubber_back['rubber_back_id'] . '/rubber1.jpg" alt="' . $rubber_back['name'] . '" height="200" width="200">');
                        print('<div>' . $rubber_back['name'] . '<br>' . $rubber_back['price'] . '円(税込)<br>スピード：' . $rubber_back['speed'] . '<br>スピン：' . $rubber_back['spin'] . '</div>');
                        ?>
                    </div>
                    <div class="chart">
                    <canvas id="myChart-1" data-four-speed='<?php print($racket_rubber['four_speed']) ?>' data-four-spin='<?php print($racket_rubber['four_spin']) ?>' data-four-stable='<?php print($racket_rubber['four_stable']) ?>' data-four-price='<?php print($racket_rubber['four_price']) ?>' data-back-speed='<?php print($racket_rubber['back_speed']) ?>' data-back-spin='<?php print($racket_rubber['back_spin']) ?>' data-back-stable='<?php print($racket_rubber['back_stable']) ?>' data-back-price='<?php print($racket_rubber['back_price']) ?>'></canvas>
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

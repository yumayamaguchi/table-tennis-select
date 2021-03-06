<?php
session_start();
require('../dbconnect.php');

$id = $_REQUEST['id'];


if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //時間の上書き、最後のログインから1時間
    $_SESSION['time'] = time();

    $login['name'] = 'success';

    //ログインしているユーザーの情報を引き出す
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
}

$rackets = $db->prepare('SELECT * FROM rackets WHERE id=?');
$rackets->execute(array($id));
$racket = $rackets->fetch();
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
    <title><?php print($racket['name']); ?></title>
</head>

<body>
    <header>
        <?php require('../header_1.php') ?>
        <div class="head_image_1">
            <p><?php print($racket['name']); ?></p>
        </div>
    </header>
    <div class="main_bar">
        <ul class="slick01">
            <li><img alt="画像1" src="../images/racket-<?php print($id); ?>/racket1.jpg" /></li>
            <li><img alt="画像2" src="../images/racket-<?php print($id); ?>/racket2.jpg" /></li>
            <li><img alt="画像3" src="../images/racket-<?php print($id); ?>/racket3.jpg" /></li>
            <li><img alt="画像3" src="../images/racket-<?php print($id); ?>/racket4.jpg" /></li>
            <li><img alt="画像3" src="../images/racket-<?php print($id); ?>/racket5.jpg" /></li>
        </ul>
    </div>


    <!-- 同じページにする -->
    <!-- 性能など、すべてPHPに登録 -->

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
            <li class="tab tab-1"><a href="racket_detail.php?id=<?php print($id); ?>">性能</a></li>
            <li class="tab tab-2"><a href="racket_word.php?id=<?php print($id); ?>">口コミ</a></li>
            <li class="tab tab-2"><a href="racket_comb.php?id=<?php print($id); ?>">お勧め組み合わせラバー</a></li>
        </ul>
        <div class="tabs-content">

            <!-- 性能 -->
            <div class="tabs-1 container">
                <div class="row tabs-1-1">
                    <table class="col-md-6">
                        <tr class="tables">
                            <th>商品名</th>
                            <td><?php print($racket['name']); ?></td>
                        </tr>
                        <tr class="tables">
                            <th>価格</th>
                            <td><?php print($racket['price']); ?>円（税込）</td>
                        </tr>
                        <tr class="tables">
                            <th>発売日</th>
                            <td><?php print($racket['release_day']); ?></td>
                        </tr>
                        <tr class="tables">
                            <th>タイプ</th>
                            <td><?php print($racket['type']); ?></td>
                        </tr>
                        <tr class="tables">
                            <th>反発特性</th>
                            <td><?php print($racket['repulsion']); ?></td>
                        </tr>
                    </table>
                    <table class="col-md-6">
                        <tr class="tables">
                            <th>振動特性</th>
                            <td><?php print($racket['vibration']); ?></td>
                        </tr>
                        <tr class="tables">
                            <th>ブレード構成</th>
                            <td><?php print($racket['constitution']); ?></td>
                        </tr>
                        <tr class="tables">
                            <th>ブレードサイズ</th>
                            <td><?php print($racket['size']); ?></td>
                        </tr>
                        <tr class="tables">
                            <th>ブレード厚</th>
                            <td><?php print($racket['thickness']); ?>mm</td>
                        </tr>
                        <tr class="tables">
                            <th>平均重量</th>
                            <td><?php print($racket['weight']); ?>g</td>
                        </tr>
                    </table>
                </div>
            </div>
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
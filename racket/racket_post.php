<?php
session_start();
require('../dbconnect.php');

$id  = $_REQUEST['id'];

$rackets = $db->prepare('SELECT * FROM rackets WHERE id=?');
$rackets->execute(array($id));
$racket = $rackets->fetch();

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //最後のログインから1時間有効
    $_SESSION['time'] = time();

    $login['name'] = 'success';

    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
} else {
    header('Location: ../login.php?id=' . $id);
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="../raty-3.0.0/lib/jquery.raty.css" rel="stylesheet" />

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
    <!-- <div class="side_bar">
    </div> -->

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
            <li class="tab tab-2"><a href="racket_detail.php?id=<?php print($id); ?>">性能</a></li>
            <li class="tab tab-1"><a href="racket_word.php?id=<?php print($id); ?>">口コミ</a></li>
            <li class="tab tab-2"><a href="racket_comb.php?id=<?php print($id); ?>">お勧め組み合わせラバー</a></li>
        </ul>
        <div class="tabs-content">
            <!-- 口コミ投稿 -->
            <div class="tabs-3">
                <form action="racket_word.php?id=<?php print($id); ?>" method="post">
                    <div>
                        <label class="evaluation">5段階評価：</label>
                        <div class="star1"></div>
                    </div>
                    <div class="row">
                        <label class="view-title col-3">レビュータイトル：</label>
                        <input class="form-control col-9" type="text" name="title" size="30" maxlength="30">
                    </div>
                    <div class="row">
                        <label class="view col-3">レビュー：</label>
                        <textarea class="form-control col-9" name="message" rows="7" cols="80" maxlength="255" placeholder="口コミを入れてください"></textarea>
                    </div>
                    <p>
                        <input class="btn btn-primary" type="submit" value="投稿する" />
                    </p>
                </form>
            </div>
            <!-- 口コミ投稿ここまで -->
        </div>
    </div>
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../jquery.raty.js"></script>
    <script src="../main.js"></script>
</body>

</html>
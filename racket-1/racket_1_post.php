<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //最後のログインから1時間有効
    $_SESSION['time'] = time();

    $login['name'] = 'success';

    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
} else {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

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

    <title>林昀儒 SUPER ZLC｜卓球製品情報｜バタフライ卓球用品</title>
</head>

<body>
    <header>
        <div class="container-fluid header">
            <div class="row">
                <div class="head col-md-6">
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="../index.php">卓球ツール</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <?php if ($login['name'] === 'success') : ?>
                            <li><a href="../logout.php">ログアウト</a>|</li>
                            <li><a href="../my-page/my-page.php">マイページ</a>|</li>
                            <li><?php print($member['name']); ?>さん、こんにちは！</li>
                        <?php else : ?>
                            <li><a href="../create.php">会員登録</a>|</li>
                            <li><a href="../login.php">ログイン</a>|</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
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
        <ul class="tabs-menu">
            <li class="tab tab-2"><a href="racket_1.php">性能</a></li>
            <li class="tab tab-1"><a href="racket_1_word.php">口コミ</a></li>
            <li class="tab tab-2"><a href="racket_1_comb.php">お勧め組み合わせラバー</a></li>
        </ul>
        <div class="tabs-content">
            <!-- 口コミ投稿 -->
            <div class="tabs-3">
                <form action="racket_1_word.php" method="post">
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
                        <textarea class="form-control col-9" name="message" rows="7" cols="80" placeholder="口コミを入れてください"></textarea>
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
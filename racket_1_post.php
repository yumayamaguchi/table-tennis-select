<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //最後のログインから1時間有効
    $_SESSION['time'] = time();

    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
} else {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <title>林昀儒 SUPER ZLC｜卓球製品情報｜バタフライ卓球用品</title>
</head>

<body>
    <header>
        <div class="container-fluid header">
            <div class="row">
                <div class="head col-md-6">
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="index.php">卓球ツール</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <li><a href="create.php">会員登録</a>|</li>
                        <li><a href="login.php">ログイン</a>|</li>
                        <li><a href="logout.php">ログアウト</a>|</li>
                        <li>
                            <a href="">
                                <?php if ($login['name'] = 'success') {
                                    print($member['name'] + 'さん、こんにちは！');
                                } ?>
                            </a>
                        </li>
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
            <li><img alt="画像1" src="images/37131_01.jpg" /></li>
            <li><img alt="画像2" src="images/37131_02.jpg" /></li>
            <li><img alt="画像3" src="images/37131_03.jpg" /></li>
            <li><img alt="画像3" src="images/37131_03.jpg" /></li>
            <li><img alt="画像3" src="images/37131_03.jpg" /></li>
        </ul>
    </div>
    <!-- <div class="side_bar">
    </div> -->

    <div class="center">
        <h3>林昀儒選手の使用モデル</h3>
        <p>
            カーボンとZLファイバーを高密度に編み込んだスーパーZLカーボン搭載ラケットは、打球の威力を引き出す弾みの良さと、広い高反発エリアによる安定性が特徴です。
            類いまれな打球感覚を持つ中華台北の新星・林昀儒選手は、高めの振動特性を持つ威力重視のこのラケットを駆使し、鋭いチキータや質の高いカウンターを生み出しています。グリップに採用された彼の好みのカラーと、名前の頭文字で構成されたウイングマークは、若さと将来の成功を感じさせます。
        </p>
        <ul class="tabs-menu">
            <li><a href=".tabs-1">性能</a></li>
            <li><a href=".tabs-2">口コミ</a></li>
            <li><a href=".tabs-3">使用選手</a></li>
        </ul>
        <div class="tabs-content">

            <!-- 性能 -->
            <div class="tabs-1 container">
                <div class="row">
                    <table class="col-md-5">
                        <tr class="tables">
                            <th>商品名</th>
                            <td>林昀儒 SUPER ZLC</td>
                        </tr>
                        <tr class="tables">
                            <th>価格</th>
                            <td>41,800円</td>
                        </tr>
                        <tr class="tables">
                            <th>発売日</th>
                            <td>2021年3月1日</td>
                        </tr>
                        <tr class="tables">
                            <th>タイプ</th>
                            <td>攻撃用シェーク</td>
                        </tr>
                        <tr class="tables">
                            <th>反発特性</th>
                            <td>12.3</td>
                        </tr>
                        <tr class="tables">
                            <th>振動特性</th>
                            <td>11.1</td>
                        </tr>
                    </table>
                    <table class="offset-md-2 col-md-5">
                        <tr class="tables">
                            <th>商品名</th>
                            <td>林昀儒 SUPER ZLC</td>
                        </tr>
                        <tr class="tables">
                            <th>aaa</th>
                            <td>bbb</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- 性能ここまで -->
            <!-- お勧め組み合わせ -->
            <div class="tabs-2">
                <form action="" method="post">
                    <textarea name="message" rows="7" cols="80" placeholder="口コミを入れてください"></textarea>
                    <p>
                        <input type="submit" value="投稿する" />
                    </p>
                </form>
            </div>
            <!-- お勧め組み合わせここまで -->
            <!-- 使用選手 -->
            <div class="tabs-3">
                <p>使用選手</p>
            </div>
            <!-- 使用選手ここまで -->
        </div>
    </div>
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="main.js"></script>
</body>

</html>
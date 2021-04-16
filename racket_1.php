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
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <table>
                        <tr>
                            <th>商品名</th>
                            <td>林昀儒 SUPER ZLC</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="main.js"></script>
</body>

</html>
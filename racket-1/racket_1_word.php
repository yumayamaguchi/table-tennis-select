<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //時間の上書き、最後のログインから1時間
    $_SESSION['time'] = time();

    $login['name'] = 'success';

    //ログインしているユーザーの情報を引き出す
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
}


if (!empty($_POST)) {
    if ($_POST['message'] !== '') {

        $members = $db->prepare('SELECT * FROM members WHERE id=?');
        $members->execute(array($_SESSION['id']));
        $member = $members->fetch();

        $message = $db->prepare('INSERT INTO posts SET title=?, member_id=?, number=?, message=?, score=?, created=NOW()');
        $message->execute(array($_POST['title'], $member['id'], $_SESSION['number'], $_POST['message'], $_POST['score']));
        header('Location: ./racket_1_word.php');
    }
}

//ページネーション
$page = $_REQUEST['page'];
if ($page == '') {
    $page = 1;
}
$page = max($page, 1);

$counts = $db->query('SELECT COUNT(*) AS cnt FROM posts');
$cnt = $counts->fetch();
$max_page = ceil($cnt['cnt'] / 3);
$page = min($page, $max_page);

$start = ($page - 1) * 3;

//LIMIT句、1の場合2件目から数える
$posts = $db->prepare('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT ?,3');
//1は?の位置を指定、$startはバインドする変数を指定
$posts->bindParam(1, $start, PDO::PARAM_INT);
$posts->execute();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../style.css">
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
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="../index.php">卓プロ</a></p>
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
        <a href="../favorite.php"><div class="favorite btn btn-warning"><i class="far fa-star"></i><span>お気に入りに追加</span></div></a>
        <ul class="tabs-menu">
            <li class="tab tab-2"><a href="racket_1.php?number=<?php print($number); ?>">性能</a></li>
            <li class="tab tab-1"><a href="racket_1_word.php?number=<?php print($number); ?>">口コミ</a></li>
            <li class="tab tab-2"><a href="racket_1_comb.php?number=<?php print($number); ?>">お勧め組み合わせラバー</a></li>
        </ul>
        <div class="tabs-content">
            <!-- 口コミ -->
            <div class="tabs-2">
                <table class="comment">
                    <tr class="line">
                        <th>投稿者</th>
                        <th>採点</th>
                        <th>タイトル</th>
                        <th>投稿された日付</th>
                        <th></th>
                    </tr>

                    <?php foreach ($posts as $post) : ?>
                        <tr class="line-1">
                            <td width="200px"><?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?></td>
                            <td width="200px">
                                <div class="star2" data-score="<?php echo $post['score']; ?>">
                                </div>
                            </td>
                            <td width="360px"><?php print(htmlspecialchars($post['title'], ENT_QUOTES)); ?></td>
                            <td width="250px"><?php print(htmlspecialchars($post['created'], ENT_QUOTES)); ?></td>
                            <?php if ($_SESSION['id'] == $post['member_id']) : ?>
                                <td width="100px"><a class="btn btn-danger" href="../delete.php?id=<?php print(htmlspecialchars($post['id'])); ?>">削除</a></td>
                            <?php endif; ?>
                        </tr>
                        <tr class="comment_2">
                            <td></td>
                            <td colspan="3" width="500px"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
                <?php
                if ($page > 1) {
                    print('<a class="figure" href="racket_1_word.php?page=' . ($page - 1) . '">前へ</a>');
                } else {
                    print('<span class="figure">前へ</span>');
                }

                for ($i = 1; $i <= $max_page; $i++) {
                    if ($i == $page) {
                        print('<span class="figure">' . $page . '</span>');
                    } else {
                        print('<a class="figure" href="racket_1_word.php?page=' . $i . '">' . $i . '</a>');
                    }
                }

                if ($page < $max_page) {
                    print('<a class="figure" href="racket_1_word.php?page=' . ($page + 1) . '">次へ</a>');
                } else {
                    print('<span class="figure">次へ</span>');
                }
                ?>
                <p>
                    <a class="btn btn-primary" href="racket_1_post.php">投稿する</a>
                </p>
            </div>
            <!-- 口コミここまで -->

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js" integrity="sha512-RGbSeD/jDcZBWNsI1VCvdjcDULuSfWTtIva2ek5FtteXeSjLfXac4kqkDRHVGf1TwsXCAqPTF7/EYITD0/CTqw==" crossorigin="anonymous"></script>
    <script src="../main.js"></script>
    <script>
        $('.star2').each(
            function(index, element) {
                console.log(element);
                $(element).raty({
                    readOnly: true,
                    score: $(element).data('score')
                });
            }
        );
    </script>
</body>

</html>
<?php
session_start();
require('../dbconnect.php');

$id  = $_REQUEST['id'];

$rubbers = $db->prepare('SELECT * FROM rubbers WHERE id=?');
$rubbers->execute(array($id));
$rubber = $rubbers->fetch();

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

        $message = $db->prepare('INSERT INTO posts SET member_id=?, racket_rubber_choice=2, racket_rubber_id=?, title=?, message=?, score=?, created_at=NOW()');
        $message->execute(array($member['id'], $_REQUEST['id'], $_POST['title'], $_POST['message'], $_POST['score']));
        header('Location:rubber_word.php?id='.$_REQUEST['id']);
        exit();
    }
}

//ページネーション
$page = $_REQUEST['page'];
if ($page == '') {
    $page = 1;
}
$page = max($page, 1);

$counts = $db->prepare('SELECT COUNT(*) AS cnt FROM posts WHERE racket_rubber_choice=2 AND racket_rubber_id=?');
$counts->execute(array($id));
$cnt = $counts->fetch();
$max_page = ceil($cnt['cnt'] / 3);
$page = min($page, $max_page);

$start = ($page - 1) * 3;

//LIMIT句、1の場合2件目から数える
$posts = $db->prepare('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id AND racket_rubber_choice=2 AND racket_rubber_id=? ORDER BY p.created_at DESC LIMIT ?,3');
//1は?の位置を指定、$startはバインドする変数を指定
$posts->bindParam(1, $id);
$posts->bindParam(2, $start, PDO::PARAM_INT);
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
    <title><?php print($rubber['name']); ?></title>
</head>

<body>
    <header>
        <?php require('../header_1.php') ?>
        <div class="head_image_1">
            <p><?php print($rubber['name']); ?></p>
        </div>
    </header>
    <div class="main_bar">
        <ul class="slick01">
            <li><img alt="画像1" src="../images/rubber-<?php print($id); ?>/rubber1.jpg" /></li>
            <li><img alt="画像2" src="../images/rubber-<?php print($id); ?>/rubber2.jpg" /></li>
            <li><img alt="画像3" src="../images/rubber-<?php print($id); ?>/rubber3.jpg" /></li>
        </ul>
    </div>
    <!-- <div class="side_bar">
    </div> -->

    <div id="center">
        <a href="../favorite.php">
            <div class="favorite btn btn-warning"><i class="far fa-star"></i><span>お気に入りに追加</span></div>
        </a>
        <ul class="tabs-menu">
            <li class="tab tab-2"><a href="rubber_detail.php?id=<?php print($id); ?>">性能</a></li>
            <li class="tab tab-1"><a href="rubber_word.php?id=<?php print($id); ?>">口コミ</a></li>
            <li class="tab tab-2"><a href="rubber_comb.php?id=<?php print($id); ?>">お勧め組み合わせラバー</a></li>
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
                            <td width="250px"><?php print(htmlspecialchars($post['created_at'], ENT_QUOTES)); ?></td>
                            <?php if ($_SESSION['id'] == $post['member_id']) : ?>
                                <td width="100px"><a class="btn btn-danger" href="../delete.php?id=<?php print($id); ?>&number=<?php print($post['id']); ?>">削除</a></td>
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
                    print('<a class="figure" href="rubber_word.php?id='.$id .'&page=' . ($page - 1) . '">前へ</a>');
                } else {
                    print('<span class="figure">前へ</span>');
                }

                for ($i = 1; $i <= $max_page; $i++) {
                    if ($i == $page) {
                        print('<span class="figure">' . $page . '</span>');
                    } else {
                        print('<a class="figure" href="rubber_word.php?id='.$id .'&page=' . $i . '">' . $i . '</a>');
                    }
                }

                if ($page < $max_page) {
                    print('<a class="figure" href="rubber_word.php?$id='.$id. '&page=' . ($page + 1) . '">次へ</a>');
                } else {
                    print('<span class="figure">次へ</span>');
                }
                ?>
                <p>
                    <a class="btn btn-primary" href="rubber_post.php?id=<?php print($id); ?>">投稿する</a>
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
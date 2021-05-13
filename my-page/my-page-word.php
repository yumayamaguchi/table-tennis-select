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
} else {
    header('Location: ../login.php');
    exit();
}


//ページネーション
$page = $_REQUEST['page'];
if ($page == '') {
    $page = 1;
}
//$pageが1より小さければ、1になる
$page = max($page, 1);

$counts = $db->prepare('SELECT COUNT(*) AS cnt FROM posts WHERE member_id=?');
$counts->execute(array($_SESSION['id']));
$cnt = $counts->fetch();

$max_page = ceil($cnt['cnt'] / 3);
$page = min($page, $max_page);

$start = ($page - 1) * 3;

//ラケットの投稿を取得
$posts = $db->prepare('SELECT * FROM posts, rackets WHERE member_id=? AND posts.tool_number = rackets.number ORDER BY posts.created_at DESC LIMIT ?,3');
$posts->bindValue(1, $_SESSION['id']);
$posts->bindParam(2, $start, PDO::PARAM_INT);
$posts->execute();

//ラバーの投稿を取得
$posts_r = $db->prepare('SELECT * FROM posts, rubbers WHERE member_id=? AND posts.tool_number = rubbers.number ORDER BY posts.created_at DESC LIMIT ?,3');
$posts_r->bindValue(1, $_SESSION['id']);
$posts_r->bindParam(2, $start, PDO::PARAM_INT);
$posts_r->execute();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>racket</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
    <!-- headerここから -->
    <header>
        <div class="container-fluid header">
            <div class="row">
                <div class="head col-md-6">
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="../index.php">卓球セレクト</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <?php if ($login['name'] === 'success') : ?>
                            <li><a href="../logout.php">ログアウト</a>|</li>
                            <li><a href="my-page.php">マイページ</a>|</li>
                            <li><?php print($member['name']); ?>さん、こんにちは！</li>
                        <?php else : ?>
                            <li><a href="../create.php">会員登録</a>|</li>
                            <li><a href="../login.php">ログイン</a>|</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="head_image mypage_head">
            <img src="../images/header_table_equipment_lg.jpg" alt="">
            <p>マイページ</p>
        </div>
    </header>
    <div id="center">
        <ul class="tabs-menu">
            <li class="tab tab-2"><a href="my-page.php">お気に入り</a></li>
            <li class="tab tab-1"><a href="my-page-word.php">口コミ</a></li>
            <li class="tab tab-2"><a href="my-page-set.php">設定</a></li>
        </ul>
        <div class="tabs-content my_page_1">
            <div class="tabs-2">
                <table class="comment">
                    <tr class="line">
                        <th>ツール</th>
                        <th>採点</th>
                        <th>タイトル</th>
                        <th>投稿された日付</th>
                        <th></th>
                    </tr>
                    <!-- ラケットの投稿一覧 -->
                    <?php foreach ($posts as $post) : ?>
                        <tr class="line-1">
                            <td width="200px">
                                <div class="tool">
                                    <img src="../images/racket<?php print(htmlspecialchars($post['number'], ENT_QUOTES)); ?>.jpg" alt="林昀儒 SUPER ZLC" height="100" width="100">
                                    <div><?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?></div>
                                </div>
                            </td>
                            <td width="200px">
                                <div class="star2" data-score="<?php echo $post['score']; ?>">
                                </div>
                            </td>
                            <td width="360px"><?php print(htmlspecialchars($post['title'], ENT_QUOTES)); ?></td>
                            <td width="250px"><?php print(htmlspecialchars($post['created_at'], ENT_QUOTES)); ?></td>

                            <td width="100px"><a class="btn btn-danger" href="../delete.php?id=<?php print(htmlspecialchars($post['id'])); ?>">削除</a></td>
                        </tr>
                        <tr class="comment_2">
                            <td></td>
                            <td colspan="3"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- ラバーの投稿一覧 -->
                    <?php foreach ($posts_r as $post) : ?>
                        <tr class="line-1">
                            <td width="200px">
                                <div class="tool">
                                    <img src="../images/racket<?php print(htmlspecialchars($post['number'], ENT_QUOTES)); ?>.jpg" alt="林昀儒 SUPER ZLC" height="100" width="100">
                                    <div><?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?></div>
                                </div>
                            </td>
                            <td width="200px">
                                <div class="star2" data-score="<?php echo $post['score']; ?>">
                                </div>
                            </td>
                            <td width="360px"><?php print(htmlspecialchars($post['title'], ENT_QUOTES)); ?></td>
                            <td width="250px"><?php print(htmlspecialchars($post['created_at'], ENT_QUOTES)); ?></td>

                            <td width="100px"><a class="btn btn-danger" href="../delete.php?id=<?php print(htmlspecialchars($post['id'])); ?>">削除</a></td>
                        </tr>
                        <tr class="comment_2">
                            <td></td>
                            <td colspan="3"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                if ($page > 1) {
                    print('<a class="figure" href="my-page-word.php?page=' . ($page - 1) . '">前へ</a>');
                } else {
                    print('<span class="figure">前へ</span>');
                }

                for ($i = 1; $i <= $max_page; $i++) {
                    if ($i == $page) {
                        print('<span class="figure">' . $page . '</span>');
                    } else {
                        print('<a class="figure" href="my-page-word.php?page=' . $i . '">' . $i . '</a>');
                    }
                }

                if ($page < $max_page) {
                    print('<a class="figure" href="my-page-word.php?page=' . ($page + 1) . '">次へ</a>');
                } else {
                    print('<span class="figure">次へ</span>');
                }
                ?>
            </div>
        </div>
    </div>
    <!-- フッターここから -->
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="../jquery.raty.js"></script>
    <script src="../main.js"></script>
    <script>
        //繰り返し処理
        $('.star2').each(
            //番号と要素
            function(index, element) {
                $(element).raty({
                    readOnly: true,
                    score: $(element).data('score')
                });
            }
        );
    </script>
</body>
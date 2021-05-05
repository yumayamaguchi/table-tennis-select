<?php
session_start();
require('../dbconnect.php');

$posts = $db->prepare('SELECT * FROM posts WHERE member_id=?');
$posts->execute(array($_SESSION['id']));

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //時間の上書き、最後のログインから1時間
    $_SESSION['time'] = time();

    $login['name'] = 'success';

    //ログインしているユーザーの情報を引き出す
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
} else {
    header('Location: login.php');
    exit();
}
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
                    <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="../index.php">卓プロ</a></p>
                </div>
                <div class="head_1 col-md-6">
                    <ul>
                        <?php if ($login['name'] === 'success') : ?>
                            <li><a href="logout.php">ログアウト</a>|</li>
                            <li><a href="my-page.php">マイページ</a>|</li>
                            <li><?php print($member['name']); ?>さん、こんにちは！</li>
                        <?php else : ?>
                            <li><a href="create.php">会員登録</a>|</li>
                            <li><a href="login.php">ログイン</a>|</li>
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
            <li class="tab tab-2"><a href="my-page.php">トップ</a></li>
            <li class="tab tab-1"><a href="my-page-word.php">口コミ</a></li>
            <li class="tab tab-2"><a href="my-page-set.php">設定</a></li>
        </ul>
        <div class="tabs-content my_page_1">
            <div class="tabs-2">
                <table class="comment">
                    <tr class="line">
                        <th>種類</th>
                        <th>採点</th>
                        <th>タイトル</th>
                        <th>投稿された日付</th>
                        <th></th>
                    </tr>
                    <?php foreach ($posts as $post) : ?>
                        <tr class="line-1">
                            <td width="200px"><?php print(htmlspecialchars($pos['name'], ENT_QUOTES)); ?></td>
                            <td width="200px">
                                <div class="star2" data-score="<?php echo $post['score']; ?>">
                                </div>
                            </td>
                            <td width="360px"><?php print(htmlspecialchars($post['title'], ENT_QUOTES)); ?></td>
                            <td width="250px"><?php print(htmlspecialchars($post['created'], ENT_QUOTES)); ?></td>

                            <td width="100px"><a class="btn btn-danger" href="../delete.php?id=<?php print(htmlspecialchars($post['id'])); ?>">削除</a></td>
                        </tr>
                        <tr class="comment_2">
                            <td></td>
                            <td colspan="3"><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <!-- フッターここから -->
    <footer>
        <p class="page_top"><a href="">PAGE TOP</a></p>
    </footer>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <script type="text/javascript">
        const showTab = (selector) => {
            console.log(selector);

            // 一旦activeクラスの削除
            $('.tabs-menu > li').removeClass('active');

            $('.tabs-content > div').hide();

            //selectorに該当するものだけactive要素を追加
            $(`.tabs-menu a[href="${selector}"]`)
                .parent('li')
                .addClass('active');

            // selectorに該当するものだけを表示
            $(selector).show();
        };
        $('.tabs-menu a').on('click', (e) => {
            e.preventDefault();

            //クリックされたhref要素の取得
            const selector = $(e.target).attr('href');
            showTab(selector);
        });

        showTab('.tabs-1');
    </script> -->
</body>
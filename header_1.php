<div class="container-fluid header">
    <div class="row">
        <div class="head col-md-6">
            <p><i class="fas fa-table-tennis fa-lg tt"></i><a href="../../index.php">卓球セレクト</a></p>
        </div>
        <div class="head_1 col-md-6">
            <ul>
                <?php if ($login['name'] === 'success') : ?>
                    <li><a href="../../logout.php">ログアウト</a>|</li>
                    <li><a href="../../my-page/my-page.php">マイページ</a>|</li>
                    <li><?php print($member['name']); ?>さん、こんにちは！</li>
                <?php else : ?>
                    <li><a href="../../create.php">会員登録</a>|</li>
                    <li><a href="../../login.php">ログイン</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/head.html' ?>

<body>
    <div class="wrapper">
        <h1 class="title"><a href="index.php">顧客管理アプリ</a></h1>
        <div class="form-area">
            <h2 class="sub-title">登録</h2>

                <ul class="errors">
                    <li></li><!-- エラーメッセージ表示 -->
                </ul>

            <form action="" method="post">
                <label for="company">会社名</label>
                <input type="text" id="company" name="company">
                <label for="name">氏名</label>
                <input type="text" id="name" name="name">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email">
                <input type="submit" class="btn submit-btn" value="追加">
            </form>
            <a href="" class="btn return-btn">戻る</a>
        </div>
    </div>
</body>

</html>
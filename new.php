<?php
require_once __DIR__ . '/functions.php';

$company = '';
$name = '';
$email = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company = filter_input(INPUT_POST, 'company');
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');

    $errors = insertValidate($company, $name, $email);

    if (empty($errors)) {
        insertCustomer($company, $name, $email);

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <div class="wrapper">
        <h1 class="title"><a href="index.php">顧客管理アプリ</a></h1>
        <div class="form-area">
            <h2 class="sub-title">登録</h2>
            <?php if($errors) echo (createErrMsg($errors)) ?>
            <form action="" method="post">
                <label for="company">会社名</label>
                <input type="text" id="company" name="company" 
                value="<?php if( !empty($_POST['company'])){echo $_POST['company'];} ?>">
                <label for="name">氏名</label>
                <input type="text" id="name" name="name" 
                value="<?php if( !empty($_POST['name'])){echo $_POST['name'];} ?>">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" 
                value="<?php if( !empty($_POST['email'])){echo $_POST['email'];} ?>">
                <input type="submit" class="btn submit-btn" value="追加">
            </form>
            <a href="index.php" class="btn return-btn">戻る</a>
        </div>
    </div>
</body>

</html>
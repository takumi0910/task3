<?php
session_start();

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

// HTML特殊文字をエスケープする関数(入力フォームに他有害サイトのリンク等の貼り付けを防ぐ)
function escape($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$token = $_POST['token'];

// トークンを確認し、確認画面を表示(トークンが一致せず、トークンが空ではない場合に追い出す)
if (!(hash_equals($token, $_SESSION['token']) && !empty($token))) {
    echo "不正アクセスの可能性があります";
    exit();
}

$token = $_SESSION['token'];

//変数に代入をしている
$name =  $_POST['name'];
$mailadress =  $_POST['mailadress'];
$number = $_POST['number'];
$content = $_POST['content'];

//入力判定
if (empty($_POST['name'])) {
    $name = "名前が入力されていません。";
} else {
    $name = $_POST['name'];
}

if (empty($_POST['number'])) {
    $number = "電話番号が入力されていません。";
} else {
    $number = $_POST['number'];
}

if (empty($_POST['mailadress'])) {
    $mailadress = "メールが入力されていません。";
} else {
    $mailadress = $_POST['mailadress'];
}

if (empty($_POST['content'])) {
    $content = "お問い合わせ内容が入力されていません。";
} else {
    $content = $_POST['content'];
}

//エラーが無ければセッションに登録
$_SESSION['name'] = $name;
$_SESSION['mailadress'] = $mailadress;
$_SESSION['number'] = $number;
$_SESSION['content'] = $content;

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>お問い合わせ</title>
    <link rel="stylesheet" type="text/css" href="stylesheet2/stylesheet2.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Demo App</h1>
        </div>

        <div class="main">
            <div class="contact-form">
                <h2 class="form-title">
                    内容確認
                </h2>
                <form method="post" action="./phpmail/sender.php" 　action="./send.html">
                    <div class="form-wrapper">
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">名前</div>
                                <div class="attention">必須</div>
                            </div>
                            <div class="personal">
                                <?php echo escape($name); ?>
                            </div>
                        </div>
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">メールアドレス</div>
                                <div class="attention">必須</div>
                            </div>
                            <div class="personal">
                                <?php echo escape($mailadress); ?>
                            </div>
                        </div>
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">電話番号</div>
                                <div class="random">任意</div>
                            </div>
                            <div class="personal">
                                <?php echo escape($number); ?>
                            </div>
                        </div>

                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">お問い合わせ内容</div>
                                <div class="attention">必須</div>
                            </div>
                            <div class="personal">
                                <?php echo nl2br(escape($content)); ?>
                                <input type="hidden" name="token" value=<?php echo escape($token); ?>>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn" value="上記の内容で送信する">
                    </post>
            </div>
        </div>


    </div>
</body>

</html>
<?php
session_start();

//クリックジャッキング対策(同一オリジン以外のページ表示の禁止)
header('X-FRAME-OPTIONS: SAMEORIGIN');

// HTML特殊文字をエスケープする関数(入力フォームに他有害サイトのリンク等の貼り付けを防ぐ)
function escape($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// トークン生成
$_SESSION['token'] = sha1(random_bytes(30));

$token = $_SESSION['token'];

$name = isset( $_SESSION[ 'name' ] ) ? $_SESSION[ 'name' ] : NULL;
$mailadress = isset( $_SESSION[ 'mailadress' ] ) ? $_SESSION[ 'mailadress' ] : NULL;
$number = isset( $_SESSION[ 'number' ] ) ? $_SESSION[ 'number' ] : NULL;
$content = isset( $_SESSION[ 'content' ] ) ? $_SESSION[ 'content' ] : NULL;

$error = isset($_SESSION['error']) ? $_SESSION['error'] : NULL;
$error_name = isset($error['name']) ? $error['name'] : NULL;
$error_mailadress = isset($error['mailadress']) ? $error['mailadress'] : NULL;
$error_content = isset($error['content']) ? $error['content'] : NULL;
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>お問い合わせ</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/stylesheet.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Demo App</h1>
        </div>
        <div class="main">
            <div class="contact-form">
                <h2 class="form-title">
                    お問い合わせ
                </h2>
                <form method="post" action="./confirm.php">
                    <div class="form-wrapper">
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">名前</div>
                                <div class="attention">必須</div>
                                <span class="error1"><?php echo $error_name; ?></span>
                            </div>
                            <input type="text" name="name" value="<?php echo ($name); ?>">
                        </div>
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">メールアドレス</div>
                                <div class="attention">必須</div>
                                <span class="error2"><?php echo $error_mailadress; ?></span>
                            </div>
                            <input type="text" name="mailadress" value="<?php echo ($mailadress); ?>">
                        </div>
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">電話番号</div>
                                <div class="random">任意</div>
                            </div>
                            <input type="text" name="number" value="<?php echo ($number); ?>">
                        </div>

                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">お問い合わせ内容</div>
                                <div class="attention">必須</div>
                                <span class="error2"><?php echo $error_content; ?></span>
                            </div>
                            <textarea name="content" cols="60"><?php echo ($content); ?></textarea>
                        </div>
                        <div>
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        </div>
                    </div>

                    <input type="submit" class="btn" value="内容を確認する">
                    </post>
            </div>
        </div>


    </div>
</body>

</html>
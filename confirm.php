<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>お問い合わせ</title>
    <link rel="stylesheet" type="text/css" href="stylesheet2/stylesheet2.css">
</head>

<body>
    <?php
    echo  $random;
    ?>

    <div class="container">
        <div class="header">
            <h1>Demo App</h1>
        </div>

        <div class="main">
            <div class="contact-form">
                <h2 class="form-title">
                    内容確認
                </h2>
                <form action=”phpmail/sender.php” method=”post”>
                    <div class="form-wrapper">
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">名前</div>
                                <div class="attention">必須</div>
                            </div>
                            <div class="personal">
                                <?php echo $_POST['name']; ?>
                            </div>
                        </div>
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">メールアドレス</div>
                                <div class="attention">必須</div>
                            </div>
                            <div class="personal">
                                <?php echo $_POST['mail']; ?>
                            </div>
                        </div>
                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">電話番号</div>
                                <div class="random">任意</div>
                            </div>
                            <div class="personal">
                                <?php echo $_POST['number']; ?>
                            </div>
                        </div>

                        <div class="form-content">
                            <div class="form-row">
                                <div class="form-item">お問い合わせ内容</div>
                                <div class="attention">必須</div>
                            </div>
                            <div class="personal">
                                <?php echo $_POST['content']; ?>
                            </div>
                        </div>
                    </div>

                    <input type="submit" class="btn" value="上記の内容で送信する"　onclick='file:///C:/xampp/htdocs/submit/send.html'>
                    </post>
            </div>
        </div>


    </div>
</body>

</html>
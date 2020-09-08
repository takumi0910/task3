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

// トークンを確認し、確認画面を表示
if(!(hash_equals($token, $_SESSION['token']) && !empty($token))) {
  echo "不正アクセスの可能性があります";
  exit();
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$inquiry_no;
$mail = new PHPMailer(true);

$error = null;

try {
  // サーバ設定
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';        // メールサーバ
  $mail->SMTPAuth = true;
  $mail->Username = 's1920501@g.tohoku-gakuin.ac.jp';  // 送信アカウント
  $mail->Password = 'Dshotgun0910';           // 送信アカウントのパスワード
  $mail->SMTPSecure = 'tls';              // TLSなどの暗号化非対応のサーバならfalseを設定。使えるなら'tls'か'ssl'を設定。
  $mail->SMTPAutoTLS = false;             // SMTPSecureをfalseにする場合はfalseにする。それ以外なら未設定で。
  $mail->Port = 587;

  // 送り先情報
  $mail->setFrom('s1920501@g.tohoku-gakuin.ac.jp');       // 送信元アドレス
  $mail->addAddress('gentakeda0910@gmail.com');  // 送信先アドレス
  $mail->addReplyTo('gentakeda0910@gmail.com');    // 返信先アドレス

  // 本文
  $mail->isHTML(false);
  $mail->CharSet = 'UTF-8';

  $name = $_SESSION['name'];
  $mailadress = $_SESSION['mailadress'];
  $number =  $_SESSION['number'];
  $content =  $_SESSION['content'];

  $mail->Body = 'お問い合わせ内容：'."\n".$content."\n"."\n".'名前：'.$name."\n".'電話番号:'.$number."\n".'メールアドレス:'.$mailadress;
  $mail->Subject = "お問い合わせ";

  $mail->send();
  header("Location: http://localhost:81/submit/send.html");
} catch (Exception $e) {
  $error = $e;
  echo $mail->ErrorInfo;
}

if ($error != null) {
  echo "send";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form method="post" action="./send.html">
<input type="hidden" name="token" value= <?php echo escape($token); ?>>
<input type= "submit">
</post>
</body>
</html>

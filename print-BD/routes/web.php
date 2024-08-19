<?php
use Illuminate\Support\Facades\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Route::get('/send-mail', function () {
    require base_path('vendor/autoload.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = env('MAIL_HOST', 'sg2plzcpnl506731.prod.sin2.secureserver.net');
        $mail->SMTPAuth   = true;
        $mail->Username   = env('MAIL_USERNAME', 'testprintmysproject@kitecareer.com');
        $mail->Password   = env('MAIL_PASSWORD', 'testprint123@');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Using SSL
        $mail->Port       = env('MAIL_PORT', 465);

        //Recipients
        $mail->setFrom(env('MAIL_FROM_ADDRESS', 'testptint@kitecareer.com'), 'Mailer');
        $mail->addAddress('soundaryabca2012@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

        $mail->send();
        return 'Message has been sent';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
});


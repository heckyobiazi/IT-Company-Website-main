<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('./vendor/autoload.php');
require 'mailingvariables.php';

function mailfunction($mail_reciever_email, $mail_reciever_name, $mail_msg, $attachment = false) {
    $mail = new PHPMailer(true);

    try {
        // SMTP
        $mail->isSMTP();

        // Optional: enable debugging while developing
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        // $mail->Debugoutput = 'html';

        $mail->Host       = $GLOBALS['mail_host'];
        $mail->Port       = $GLOBALS['mail_port'];
        // pick encryption: either 'ssl' (465) or 'tls' (587)
        if (!empty($GLOBALS['mail_smtp_secure']) && $GLOBALS['mail_smtp_secure'] === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }

        $mail->SMTPAuth   = true;
        $mail->Username   = $GLOBALS['mail_sender_email'];
        $mail->Password   = $GLOBALS['mail_sender_password'];

        $mail->setFrom($GLOBALS['mail_sender_email'], $GLOBALS['mail_sender_name']);
        $mail->addAddress($mail_reciever_email, $mail_reciever_name);

        $mail->Subject = 'Someone Contacted You!';
        $mail->isHTML(true);
        $mail->msgHTML($mail_msg);

        if ($attachment !== false) {
            $mail->addAttachment($attachment);
        }

        if (!$mail->send()) {
            return ['status' => false, 'error' => $mail->ErrorInfo];
        }

        return ['status' => true];
    } catch (Exception $e) {
        // PHPMailer\Exception message
        return ['status' => false, 'error' => $e->getMessage()];
    }
}
?>

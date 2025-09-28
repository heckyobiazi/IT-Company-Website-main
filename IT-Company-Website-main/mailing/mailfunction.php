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

        $mail->Host       = 'smtp.ionos.com';
        $mail->Port       = 587;
        // pick encryption: either 'ssl' (465) or 'tls' (587)
       /* if (!empty($GLOBALS['mail_smtp_secure']) && $GLOBALS['mail_smtp_secure'] === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }*/

        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@ak-globalservices.org';
        $mail->Password   = '0l0run1f3E$ePup0!!%';

        $mail->setFrom('info@ak-globalservices.org', 'AK-Global Services');
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

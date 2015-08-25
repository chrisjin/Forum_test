<?php

/**
 * emailutil short summary.
 *
 * emailutil description.
 *
 * @version 1.0
 * @author C
 */
class EmailUtil
{
    static function send($rec, $title, $content, $ishtml = true)
    {
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = EMAIL_HOST;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL_ADDRESS;                 // SMTP username
        $mail->Password = EMAIL_PASSWORD;                           // SMTP password
        $mail->SMTPSecure = EMAIL_SECURE;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = EMAIL_HOST_PORT;                                    // TCP port to connect to
        //$mail->SMTPDebug  = 2; 
        $mail->From = EMAIL_ADDRESS;
        $mail->FromName = EMAIL_FROMNAME;
        $mail->addAddress($rec);               // Name is optional
        
        $mail->Subject = $title;
        $mail->Body    = $content;
        $mail->isHTML($ishtml);  
        if(!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends Model
{
    public function send($data = array())
    {
    	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'nguyenthanhhiep9917@gmail.com';                 // SMTP username
        $mail->Password = '01884139917';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->SMTPDebug = false;
        $mail->do_debug = 0;
        $mail->Port = 587;                                    // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('nguyenthanhhiep9917@gmail.com', 'Admin');
        $mail->addAddress($data['email'], '');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $data['subject'];
        $mail->Body    = $data['body'];
        $mail->AltBody = '';
        $mail->send();   	
    }
}

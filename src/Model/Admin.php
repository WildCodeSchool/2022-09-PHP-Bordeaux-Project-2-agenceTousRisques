<?php

namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends AbstractManager
{
    public function codeGenerator(): string
    {
        $query = 'SELECT activationCode FROM user';
        $statement = $this->pdo->query($query);
        $codes = $statement->fetchAll();
        $listOfCode = [];
        foreach ($codes as $code) {
            $listOfCode[] = $code['activationCode'];
        }
        $activationCode = bin2hex(random_bytes(5));
        if (in_array($activationCode, $listOfCode)) {
            return $this->codeGenerator();
        } else {
            return $activationCode;
        }
    }

    public function sendEmail($email, $code)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = SMTP_USERNAME;                     //SMTP username
            $mail->Password = SMTP_PASSWORD;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(SMTP_USERNAME);
            $mail->addAddress("$email");
            //Add a recipient
            //Content
            $mail->CharSet = 'UTF-8';
            include('assets/mail_content.php');
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Invitation à rejoindre notre communauté !';
            $link = "http://localhost:8000/userInscription?code=$code&email=$email";
            $mail->Body = "<h1> Vous avez été invité à rejoindre la communauté des nounous entre nous !</h1>
<br><br>
<p>Pour vous inscrire, il vous suffit de suivre le lien ci-dessous :</p>
<a href=$link>
                Inscrivez-vous pour rejoindre votre groupe de kangou !</a>
<br><br>
<p>A bientôt !</p>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

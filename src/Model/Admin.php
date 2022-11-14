<?php

namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends AbstractManager
{
    public function codeGenerator(): string
    {
        $query = 'SELECT activationCode FROM User';
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

    public function setMailer(): PHPMailer
    {
        $mail = new PHPMailer();
        //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = SMTP_USERNAME;                     //SMTP username
        $mail->Password = SMTP_PASSWORD;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';

        $mail->isHTML(true);
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom(SMTP_USERNAME);

        //Add a recipient
        //Content
        return $mail;
    }

    public function sendInvitationEmail($email, $code)
    {
        $mail = $this->setMailer();
        try {
            $mail = $this->setMailer();
            $mail->addAddress("$email");
            //Set email format to HTML
            $mail->Subject = 'Invitation à rejoindre notre communauté !';
            $link = "http://localhost:8000/userInscription?code=$code&email=$email";
            $body = "<h1> Vous avez été invité à rejoindre la communauté des nounous entre nous !</h1>
<br><br>
<p>Pour vous inscrire, il vous suffit de suivre le lien ci-dessous :</p>
<a href=$link>
    Inscrivez-vous pour rejoindre votre groupe de kangou !</a>
<br><br>
<p>A bientôt !</p>";
            $mail->Body = $body;
            $mail->AltBody = 'Vous avez été invité à rejoindre la communauté Nounou entre Nous';
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function showUser(): array
    {
        $statementUser = $this->pdo->prepare('SELECT  U.firstname, U.lastname, COUNT(helperID) as compteur, A.image
            FROM `Call`
            INNER JOIN User U on `Call`.helperID = U.userID
            INNER JOIN Avatar A on U.avatar = A.avatarID
            WHERE (MONTH(CURRENT_DATE)  = MONTH(startdate))
            GROUP BY U.userID
            ORDER BY compteur DESC');
        $statementUser->execute();
        return $statementUser->fetchAll();
    }

    public function showUserPrevious(): array
    {
        $statementUser = $this->pdo->prepare('SELECT  U.firstname, U.lastname, COUNT(helperID) as compteur, A.image
            FROM `Call`
            INNER JOIN User U on `Call`.helperID = U.userID
            INNER JOIN Avatar A on U.avatar = A.avatarID
            WHERE (MONTH(CURRENT_DATE) - 1  = MONTH(startdate))
            GROUP BY U.userID
            ORDER BY compteur DESC');
        $statementUser->execute();
        return $statementUser->fetchAll();
    }

    public function sendDeletionEmail($email)
    {
        $mail = $this->setMailer();
        try {
            $mail->addAddress("$email");
            //Add a recipient
            //Content
            $body = "<h1> Vous ne faites désormais plus partie de la communauté Nounou entre Nous</h1>
<br><br>
<p>Nous sommes dans le regret de vous annoncer que vous avez été exclus de la communauté Nounou entre Nous. </p>
<p>Si vous ne comprenez pas cette décision, veuillez contacter l'administrateur de votre groupe.</p>
<br><br>";
            $mail->Subject = 'Vous avez été exclus de la communauté Nounou entre Nous !';
            $mail->Body = $body;
            $mail->AltBody = "Vous avez été exclus de la communauté Nounou entre Nous. Si vous ne comprenez pas
            cette décision, veuillez contacter l'administrateur de votre groupe.";
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

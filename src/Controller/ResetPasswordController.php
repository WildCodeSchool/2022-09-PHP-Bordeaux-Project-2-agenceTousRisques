<?php

namespace App\Controller;

use App\Model\MailModel;
use App\Model\ResetPassword;

class ResetPasswordController extends AbstractController
{
    public function showResetPassword(): array|string|null
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $resetPassword = new ResetPassword();
            $emailVerify = $resetPassword->getEmailVerify($email);
            if ($emailVerify) {
                $password = $resetPassword->resetPassword($email);
                $mailing = new MailModel();
                $mailing->sendNewPasswordEmail($email, $password);
            }
            echo "<script>alert('Un email vous a été envoyé si celui-ci est correct.')
                    </script>";
            header('Refresh:0 /');
            return null;
        }
        return $this->twig->render('UserPage/resetPassword.html.twig');
    }
}

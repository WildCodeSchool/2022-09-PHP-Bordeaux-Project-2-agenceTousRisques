<?php

namespace App\Controller;

use App\Model\Admin;

class AdminController extends AbstractController
{
    public function administrationPanel()
    {
        return $this->twig->render('Admin/index.html.twig');
    }

    public function validateEmail($email): array|string
    {
        $errors = [];
        if (empty(trim($email))) {
            $errors[] = 'Veuillez renseigner une addresse mail';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'addresse email renseignée est invalide";
        }
        return $errors;
    }

    public function inviteUser()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $invitedEmail = $_POST['invitedEmail'];
            if (empty($this->validateEmail($invitedEmail))) {
                $invitationSuccess = $invitedEmail . 'a été invité avec succès !';
                $admin = new Admin();
                $activationCode = $admin->codeGenerator();
                $admin->sendEmail($invitedEmail, $activationCode);
                return $this->twig->render('Admin/index.html.twig', [
                    'invitationSuccess' => $invitationSuccess,
                    'code' => $activationCode,
                ]);
            } else {
                return $this->twig->render('Admin/index.html.twig', [
                    'errors' => $this->validateEmail($invitedEmail)
                ]);
            }
        }
    }
}

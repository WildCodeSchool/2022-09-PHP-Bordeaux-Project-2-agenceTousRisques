<?php

namespace App\Controller;

use App\Model\Admin;

class AdminController extends AbstractController
{
    public function administrationPanel()
    {
        $usersView = new Admin();
        $users = $usersView->showUser();
        $usersPrevious = $usersView->showUserPrevious();
        return $this->twig->render('Admin/index.html.twig', ['users' => $users, 'usersPrevious' => $usersPrevious]);
    }

    public function validateEmail($email): array|string
    {
        $errors = [];
        if (empty(trim($email))) {
            $errors[] = 'Veuillez renseigner une adresse mail';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email renseignée est invalide";
        }
        return $errors;
    }

    public function inviteUser()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $invitedEmail = $_POST['invited-email'];
            if (empty($this->validateEmail($invitedEmail))) {
                $admin = new Admin();
                $activationCode = $admin->codeGenerator();
                $admin->sendEmail($invitedEmail, $activationCode);
                return $this->twig->render('Admin/index.html.twig', [
                    'email' => $invitedEmail,
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

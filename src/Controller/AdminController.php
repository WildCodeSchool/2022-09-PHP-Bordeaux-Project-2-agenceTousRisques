<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    public function inviteUserForm()
    {
        return $this->twig->render('Item/adminInviteUser.html.twig');
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

    public function invite()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $invitedEmail = $_POST['invitedEmail'];
            if (empty($this->validateEmail($invitedEmail))) {
                $invitationSuccess = $invitedEmail . 'a été invité avec succès !';
                return $this->twig->render('Item/userGotInvited.html.twig', [
                    'invitationSuccess' => $invitationSuccess
                ]);
            } else {
                return $this->twig->render('Item/userGotInvited.html.twig', [
                    'errors' => $this->validateEmail($invitedEmail)
                ]);
            }
        }
    }
}

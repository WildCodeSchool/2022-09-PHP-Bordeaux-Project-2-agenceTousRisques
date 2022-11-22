<?php

namespace App\Controller;

use App\Model\Admin;
use App\Model\DeleteModel;
use App\Model\MailModel;

class AdminController extends AbstractController
{
    public function administrationPanel()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /');
        } else {
            $usersView = new Admin();
            $users = $usersView->showUser();
            $usersPrevious = $usersView->showUserPrevious();
            return $this->twig->render('Admin/index.html.twig', [
                'users' => $users,
                'usersPrevious' => $usersPrevious
            ]);
        }
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
        $usersView = new Admin();
        $users = $usersView->showUser();
        $usersPrevious = $usersView->showUserPrevious();
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $invitedEmail = $_POST['invited-email'];
            if (empty($this->validateEmail($invitedEmail))) {
                $mailing = new MailModel();
                $admin = new Admin();
                $activationCode = $admin->codeGenerator();
                $mailing->sendInvitationEmail($invitedEmail, $activationCode);
                return $this->twig->render('Admin/index.html.twig', [
                    'email' => $invitedEmail,
                    'code' => $activationCode,
                    'users' => $users,
                    'usersPrevious' => $usersPrevious
                ]);
            } else {
                return $this->twig->render('Admin/index.html.twig', [
                    'errors' => $this->validateEmail($invitedEmail),
                    'users' => $users,
                    'usersPrevious' => $usersPrevious
                ]);
            }
        }
    }

    public function delete()
    {
        $usersView = new Admin();
        $users = $usersView->showUser();
        $usersPrevious = $usersView->showUserPrevious();
        $message = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $message[] = "Email obligatoire";
                return $this->twig->render('Admin/index.html.twig', [
                    'message' => $message,
                    'users' => $users,
                    'usersPrevious' => $usersPrevious
                ]);
            } else {
                $deleteModel = new DeleteModel();
                $mailing = new MailModel();
                $emailfound = $deleteModel->selectOneByEmail($_POST['email']);
                if ($emailfound == false) {
                    $message[] = "Email introuvable";
                    return $this->twig->render('Admin/index.html.twig', [
                        'message' => $message,
                        'users' => $users,
                        'usersPrevious' => $usersPrevious
                    ]);
                } elseif (($emailfound == true)) {
                    $deleteModel->updateUser($_POST['email']);
                    $mailing->sendDeletionEmail($_POST['email']);
                    $message[] = "Utilisateur supprimé";
                    return $this->twig->render('Admin/index.html.twig', [
                        'message' => $message,
                        'users' => $users,
                        'usersPrevious' => $usersPrevious
                    ]);
                }
            }
        }
        return $this->twig->render('Admin/index.html.twig', [
            'message' => $message,
            'users' => $users,
            'usersPrevious' => $usersPrevious
        ]);
    }
}

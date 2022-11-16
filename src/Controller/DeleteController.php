<?php

namespace App\Controller;

use App\Model\DeleteModel;
use App\Model\Admin;
use App\Model\MailModel;

class DeleteController extends AbstractController
{
    public function delete()
    {
        $message = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $message[] = "Email obligatoire";
                return $this->twig->render('Admin/index.html.twig', [
                    'message' => $message
                ]);
            } else {
                $deleteModel = new DeleteModel();
                $mailing = new MailModel();
                $emailfound = $deleteModel->selectOneByEmail($_POST['email']);
                if ($emailfound == false) {
                    $message[] = "Email non disponible";
                    return $this->twig->render('Admin/index.html.twig', [
                        'message' => $message]);
                } elseif (($emailfound == true)) {
                    $deleteModel->updateUser($_POST['email']);
                    $mailing->sendDeletionEmail($_POST['email']);
                    $message[] = "Utilisateur supprimé";
                    return $this->twig->render('Admin/index.html.twig', [
                        'message' => $message]);
                }
            }
        }
        return $this->twig->render('Admin/index.html.twig', [
            'message' => $message]);
    }
}

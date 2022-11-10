<?php

namespace App\Controller;

use App\Model\AddDemandManager;

class AddDemandController extends AbstractController
{
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $addDemand = array_map('trim', $_POST);
            $addDemandManager = new AddDemandManager();
            $errors = $addDemandManager->validFormCompletedAddDemand($addDemand);
            if (sizeof($errors)) {
                $addDemandManager->insertDemand($addDemand);
                echo "<script>alert('Demande Ajoutée. \\nVous recevrez une notification dès acceptation.')</script>";
                header('Refresh:0 UserPage');
                return null;
            } else {
                foreach ($errors as $error) {
                    echo "<p>" . $error . "</p>";
                }
            }
        }
        return $this->twig->render('Home/addDemand.html.twig');
    }
}

<?php

namespace App\Controller;

use App\Model\UserConnectionModel;

class UserConnectionController extends AbstractController
{
    public function access(): string
    {
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $logs = array_map('trim', $_POST);
            $logs = array_map('htmlentities', $logs);
            // Validate data
            $logsCheckValidation = new UserConnectionModel();
            $errors = $logsCheckValidation->validation($logs);

            // Check the connection
            if (empty($errors)) {
                $accessEmail = $logs['email'];
                $accessPassword = $logs['password'];
                $logsCheck = new UserConnectionModel();
                $authorizationResult = $logsCheck->access($accessEmail, $accessPassword);

                if ($authorizationResult === true) {
                    //setting session
                    $gettingId = new UserConnectionModel();
                    $user = $gettingId->selectOneByEmail($accessEmail);
                    $_SESSION['user_id'] = $user['userID'];
                    header('Location:/UserPage');
                } else {
                    $errors[] = "Les informations que vous avez saisi ne sont pas associées à un compte";
                }
            }
        }
        // Generate the web page
        return $this->twig->render('Home/index.html.twig', [
            'errors' => $errors
        ]);
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_id']);
        header('Location:/');
    }
}

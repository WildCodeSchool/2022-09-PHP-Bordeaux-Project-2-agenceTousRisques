<?php

namespace App\Controller;

use App\Model\DeleteCallAdmin;

class DeleteCallAdminController extends AbstractController
{
    public function showUserCallsToDelete(): string
    {
        $userCallsModel = new DeleteCallAdmin();
        $userCalls = $userCallsModel->getCallsToDelete();
        if (isset($_GET['callId'])) {
            $userCallsModel -> deleteCallAdmin($_GET['callId']);
            header('Location: /gestion');
        }
        return $this->twig->render('Admin/adminDeleteCallView.html.twig', [
            'Calls' => $userCalls
        ]);
    }
}

<?php

namespace App\Controller;

use App\Model\UserCallsModel;

class UserCallsController extends AbstractController
{
    public function showUserCalls(): string
    {
        $userCallsModel = new UserCallsModel();
        $userCalls = $userCallsModel->getCalls();
        return $this->twig->render('UserCalls/index.html.twig', [
            'Calls' => $userCalls
        ]);
    }
}

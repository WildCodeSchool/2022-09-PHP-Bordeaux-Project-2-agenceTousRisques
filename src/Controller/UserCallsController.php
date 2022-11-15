<?php

namespace App\Controller;

use App\Model\MailModel;
use App\Model\UserCallsModel;
use App\Model\AcceptCallModel;

class UserCallsController extends AbstractController
{
    public function showUserCalls(): string
    {
        $userCallsModel = new UserCallsModel();
        $userCalls = $userCallsModel->getCalls();

        if (isset($_GET['id'])) {
            $acceptCall = new AcceptCallModel();
            $acceptCall->acceptCall();
            $callDataForMail = $acceptCall->getDataFromCallID($_GET['id']);
            $askerMail = $callDataForMail['email'];
            $callStartDate = $callDataForMail['startdate'];
            $mailing = new MailModel();
            $mailing->sendDemandAcceptedEmail($askerMail, $callStartDate);
            header('Location: UserPage');
        }
        return $this->twig->render('UserCalls/index.html.twig', [
            'Calls' => $userCalls
        ]);
    }
}

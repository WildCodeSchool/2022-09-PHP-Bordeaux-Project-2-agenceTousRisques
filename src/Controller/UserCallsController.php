<?php

namespace App\Controller;

use App\Model\MailModel;
use App\Model\UserCallsModel;
use App\Model\AcceptCallModel;

class UserCallsController extends AbstractController
{
    public function showUserCalls(): string
    {
        $errors = [];
        $userCallsModel = new UserCallsModel();
        $userCalls = $userCallsModel->getCalls();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['filterDate'] === "") {
                $errors[] = "Veuillez selectionner une date";
            } else {
                $userCalls = $userCallsModel->getCallsByDay($_POST['filterDate']);
            }
        }
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
            'Calls' => $userCalls,
            'errors' => $errors
        ]);
    }
}

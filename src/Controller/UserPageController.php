<?php

namespace App\Controller;

use App\Model\UserPlanningModel;
use Cassandra\Date;

class UserPageController extends AbstractController
{
    public function showUserPage()
    {
        $planningController = new UserPlanningController();
        $mondayDemands = $planningController->getMondayDemands();
        $tuesdayDemands = $planningController->getTuesdayDemands();
        $wednesdayDemands = $planningController->getWednesdayDemands();
        $thursdayDemands = $planningController->getThursdayDemands();
        $fridayDemands = $planningController->getFridayDemands();
        $saturdayDemands = $planningController->getSaturdayDemands();
        $sundayDemands = $planningController->getSundayDemands();
        return $this->twig->render('UserPage/index.html.twig', [
            'mondayDemands' => $mondayDemands,
            'tuesdayDemands' => $tuesdayDemands,
            'wednesdayDemands' => $wednesdayDemands,
            'thursdayDemands' => $thursdayDemands,
            'fridayDemands' => $fridayDemands,
            'saturdayDemands' => $saturdayDemands,
            'sundayDemands' => $sundayDemands
        ]);
    }
}

<?php

namespace App\Controller;

use App\Model\UserPlanningModel;
use Cassandra\Date;

class UserPageController extends AbstractController
{
    public function showUserPage()
    {
        $planningController = new UserPlanningController();
        $monday = $planningController->getMondayDemands();
        $tuesday = $planningController->getTuesdayDemands();
        $wednesday = $planningController->getWednesdayDemands();
        $thursday = $planningController->getThursdayDemands();
        $friday = $planningController->getFridayDemands();
        $saturday = $planningController->getSaturdayDemands();
        $sunday = $planningController->getSundayDemands();
        return $this->twig->render('UserPage/index.html.twig', [
            'mondayDemands' => $monday,
            'tuesdayDemands' => $tuesday,
            'wednesdayDemands' => $wednesday,
            'thursdayDemands' => $thursday,
            'fridayDemands' => $friday,
            'saturdayDemands' => $saturday,
            'sundayDemands' => $sunday,
        ]);
    }
}

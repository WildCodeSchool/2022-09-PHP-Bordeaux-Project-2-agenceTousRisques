<?php

namespace App\Controller;

use App\Model\UserPlanningModel;
use Cassandra\Date;

class UserPageController extends AbstractController
{
    public function showUserPage()
    {
        $planningController = new UserPlanningController();
        $week = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
        $demandsOfCurrentWeek = [];
        foreach ($week as $day) {
            $demandsOfCurrentWeek[$day] = $planningController->getDemandsOfDay($day);
        }
        return $this->twig->render('UserPage/index.html.twig', [
            'demandsByDay' => $demandsOfCurrentWeek,
        ]);
    }
}

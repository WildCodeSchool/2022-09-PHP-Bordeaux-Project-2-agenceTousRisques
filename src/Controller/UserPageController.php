<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\UserPlanningModel;
use Cassandra\Date;

class UserPageController extends AbstractController
{
    public function showUserPage()
    {
        $dataView = new UserManager();
        $dataAPI = $dataView->opendataAPI();
        $dataAPI = json_decode($dataAPI, true);
        $planningController = new UserPlanningController();
        $week = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $demandsOfCurrentWeek = [];
        foreach ($week as $day) {
            $demandsOfCurrentWeek[$day] = $planningController->getDemandsOfDay($day);
        }
        $userSliderController = new UserSliderController();
        $team = $userSliderController->show();
        $userUnaccepted = new UserUnacceptedDemandController();
        $demand = $userUnaccepted->show();
        return $this->twig->render('UserPage/index.html.twig', [
            'team' => $team,
            'demand' => $demand,
            'demandsByDay' => $demandsOfCurrentWeek,
            'dataAPI' => $dataAPI,
        ]);
    }
}

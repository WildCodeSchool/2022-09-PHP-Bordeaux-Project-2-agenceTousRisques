<?php

namespace App\Controller;

use DateTime;
use App\Model\UserPlanningModel;

class UserPlanningController
{
    private array|false $userDemands;
    private \DateTime $date;
    private string $currentWeek;
    private UserPlanningModel $userPlanningModel;
    private array $correspondantDay;

    public function __construct()
    {
        $this->userPlanningModel = new UserPlanningModel();
        $this->date = new DateTime();
        $this->userDemands = $this->userPlanningModel->getUserDemands($_SESSION['user_id']);
        $this->currentWeek = $this->date->format('W');
        $this->correspondantDay = [
            'Lundi' => 'Mon',
            'Mardi' => 'Tue',
            'Mercredi' => 'Wed',
            'Jeudi' => 'Thu',
            'Vendredi' => 'Fri',
            'Samedi' => 'Sat',
            'Dimanche' => 'Sun'
        ];
    }

    public function getDemandsOfDay(string $day): array
    {
        $dayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === $this->correspondantDay[$day]) {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $dayDemands[] = $demand;
            }
        }
        return $dayDemands;
    }
}

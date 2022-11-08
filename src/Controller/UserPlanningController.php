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

    public function __construct()
    {
        $this->userPlanningModel = new UserPlanningModel();
        $this->date = new DateTime();
        $this->userDemands = $this->userPlanningModel->getUserDemands($_SESSION['user_id']);
        $this->currentWeek = $this->date->format('W');
    }

    public function getTuesdayDemands(): array
    {
        $tuesdayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === "Tue") {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $tuesdayDemands[] = $demand;
            }
        }
        return $tuesdayDemands;
    }

    public function getMondayDemands()
    {
        $mondayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === "Mon") {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $mondayDemands[] = $demand;
            }
        }
        return $mondayDemands;
    }

    public function getWednesdayDemands()
    {
        $wednesdayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === "Wed") {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $wednesdayDemands[] = $demand;
            }
        }
        return $wednesdayDemands;
    }

    public function getThursdayDemands()
    {
        $thursdayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === "Thu") {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $thursdayDemands[] = $demand;
            }
        }
        return $thursdayDemands;
    }

    public function getFridayDemands()
    {
        $fridayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === "Fri") {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $fridayDemands[] = $demand;
            }
        }
        return $fridayDemands;
    }

    public function getSaturdayDemands()
    {
        $saturdayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === "Fri") {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $saturdayDemands[] = $demand;
            }
        }
        return $saturdayDemands;
    }

    public function getSundayDemands()
    {
        $sundayDemands = [];
        foreach ($this->userDemands as $demand) {
            $demandDate = new DateTime($demand['startdate']);
            $dayOfDemand = $demandDate->format('D');
            $weekOfDemand = $demandDate->format('W');
            if ($weekOfDemand === $this->currentWeek && $dayOfDemand === "Fri") {
                $demand['askerName'] = $this->userPlanningModel->getAskerName($demand['userID']);
                $demand['helperName'] = $this->userPlanningModel->getAskerName($demand['helperID']);
                $sundayDemands[] = $demand;
            }
        }
        return $sundayDemands;
    }
}

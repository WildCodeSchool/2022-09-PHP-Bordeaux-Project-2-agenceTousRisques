<?php

namespace App\Controller;

use DateTime;
use App\Model\UserPlanningModel;

class UserPlanningController
{
    private array|false $userDemands;
    private \DateTime $date;
    private string $currentWeek;
    public function __construct()
    {
        $userPlanningModel = new UserPlanningModel();
        $this->date = new DateTime();
        $this->userDemands = $userPlanningModel->getUserDemands($_SESSION['user_id']);
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
                $sundayDemands[] = $demand;
            }
        }
        return $sundayDemands;
    }
}

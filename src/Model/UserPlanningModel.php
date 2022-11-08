<?php

namespace App\Model;

class UserPlanningModel extends AbstractManager
{
    public function getUserDemands(int $userId): array
    {
        $query = "SELECT * FROM `Call` WHERE userID=:userId AND helperID IS NOT NULL OR helperID=:userId ";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('userId', $userId, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}

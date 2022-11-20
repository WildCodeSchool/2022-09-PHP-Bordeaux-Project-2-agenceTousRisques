<?php

namespace App\Model;

class UserCallsModel extends AbstractManager
{
    public function getCalls(): array
    {
        $query = "SELECT U.firstname, startdate, enddate, context, comment, callID, `Call`.userID
            FROM `Call`
            INNER JOIN `User` U on `Call`.userID = U.userID
            WHERE U.UserID != " . $_SESSION['user_id'] . " AND helperID IS NULL
            ORDER BY startdate";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $calls = $statement->fetchAll();
        return $calls;
    }

    public function getCallsByDay($day): array
    {
        $query = "SELECT U.firstname, startdate, enddate, context, comment, callID, `Call`.userID
            FROM `Call`
            INNER JOIN `User` U on `Call`.userID = U.userID
            WHERE U.UserID != " . $_SESSION['user_id'] . " AND helperID IS NULL AND startdate LIKE :day";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':day', "$day%");
        $statement->execute();
        return $statement->fetchAll();
    }
}

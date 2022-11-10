<?php

namespace App\Model;

class UserCallsModel extends AbstractManager
{
    public function getCalls(): array
    {
        $query = "SELECT U.firstname, startdate, enddate, context, comment, callID
            FROM `Call`
            INNER JOIN `User` U on `Call`.userID = U.userID
            WHERE U.UserID != " . $_SESSION['user_id'] . " AND helperID IS NULL
            ORDER BY startdate";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $calls = $statement->fetchAll();
        return $calls;
    }
}

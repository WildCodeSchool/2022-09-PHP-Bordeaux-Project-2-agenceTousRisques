<?php

namespace App\Model;

use PDO;

class DeleteCallAdmin extends AbstractManager
{
    public function getCallsToDelete(): array
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

    public function deleteCallAdmin($callId): void
    {
        $query = "DELETE FROM `Call` WHERE callID = :callId";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('callId', $callId, PDO::PARAM_INT);
        $statement->execute();
    }
}

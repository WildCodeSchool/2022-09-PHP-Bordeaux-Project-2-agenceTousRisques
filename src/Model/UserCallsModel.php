<?php

namespace App\Model;

class UserCallsModel extends AbstractManager
{
    public function getCalls()
    {
        $query = "SELECT * FROM `call` WHERE userID !=" . $_SESSION['user_id'] . " ORDER BY startdate";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $calls = $statement->fetchAll();
        return $calls;
    }
}

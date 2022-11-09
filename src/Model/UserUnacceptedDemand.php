<?php

namespace App\Model;

use PDO;

class UserUnacceptedDemand extends AbstractManager
{
    public function getUnaccepted(): array
    {
        $statementUnaccepted = $this->pdo->prepare('SELECT startdate, enddate, context, comment FROM `Call`
                                             WHERE userID = :id && helperID IS NULL;');
        $statementUnaccepted->bindValue('id', $_SESSION['user_id'], PDO::PARAM_INT);
        $statementUnaccepted->execute();
        return $statementUnaccepted->fetchAll();
    }
}

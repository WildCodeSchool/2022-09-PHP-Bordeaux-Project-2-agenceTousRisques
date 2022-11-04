<?php

namespace App\Model;

use PDO;
use DateTime;

class AddDemandManager extends AbstractManager
{
    public const TABLE = 'user';

    public function insertDemand(array $addDemand): void
    {
        $statementAdd = $this->pdo->prepare("INSERT INTO `Call`
    (userID, startdate, enddate, context, comment)
    VALUES
        (:userID, :startdate, :enddate, :context, :comment)");
        // ToDo Modif Id User
        $statementAdd->bindValue('userID', $_SESSION['user_id'], PDO::PARAM_INT);
        $statementAdd->bindValue('startdate', $addDemand['startDate'], PDO::PARAM_STR);
        $statementAdd->bindValue('enddate', $addDemand['endDate'], PDO::PARAM_STR);
        $statementAdd->bindValue('context', $addDemand['context'], PDO::PARAM_STR);
        $statementAdd->bindValue('comment', $addDemand['comment'], PDO::PARAM_STR);
        $statementAdd->execute();
    }

    public function validFormCompletedAddDemand($addDemand): ?array
    {
        // ToDo Vérif choix contexte + diff date start/end
        $errors = [];
        $errors[] = $this->issetInput($addDemand['startDate'], 'Date obligatoire');
        $errors[] = $this->issetInput($addDemand['endDate'], 'Date obligatoire');
        $errors[] = $this->issetInput($addDemand['context'], 'Context obligatoire');
        $errors[] = $this->issetInput($addDemand['comment'], 'Commentaire obligatoire');
        $date1 = new DateTime($addDemand['startDate']);
        $date2 = new DateTime($addDemand['endDate']);
        $interval = $date1->diff($date2);
        if (($interval->m) < 0) {
            $errors[] = 'Dates incorrectes';
        }
        return $errors;
    }

    public function issetInput($input, $message): ?string
    {
        if (!isset($input) || (empty(trim($input)))) {
            return $message;
        }
        return null;
    }
}

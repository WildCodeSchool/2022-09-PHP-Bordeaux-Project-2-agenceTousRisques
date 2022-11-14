<?php

namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Admin extends AbstractManager
{
    public function codeGenerator(): string
    {
        $query = 'SELECT activationCode FROM User';
        $statement = $this->pdo->query($query);
        $codes = $statement->fetchAll();
        $listOfCode = [];
        foreach ($codes as $code) {
            $listOfCode[] = $code['activationCode'];
        }
        $activationCode = bin2hex(random_bytes(5));
        if (in_array($activationCode, $listOfCode)) {
            return $this->codeGenerator();
        } else {
            return $activationCode;
        }
    }
    public function showUser(): array
    {
        $statementUser = $this->pdo->prepare('SELECT  U.firstname, U.lastname, COUNT(helperID) as compteur, A.image
            FROM `Call`
            INNER JOIN User U on `Call`.helperID = U.userID
            INNER JOIN Avatar A on U.avatar = A.avatarID
            WHERE (MONTH(CURRENT_DATE)  = MONTH(startdate))
            GROUP BY U.userID
            ORDER BY compteur DESC');
        $statementUser->execute();
        return $statementUser->fetchAll();
    }

    public function showUserPrevious(): array
    {
        $statementUser = $this->pdo->prepare('SELECT  U.firstname, U.lastname, COUNT(helperID) as compteur, A.image
            FROM `Call`
            INNER JOIN User U on `Call`.helperID = U.userID
            INNER JOIN Avatar A on U.avatar = A.avatarID
            WHERE (MONTH(CURRENT_DATE) - 1  = MONTH(startdate))
            GROUP BY U.userID
            ORDER BY compteur DESC');
        $statementUser->execute();
        return $statementUser->fetchAll();
    }
}

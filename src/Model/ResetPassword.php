<?php

namespace App\Model;

use PDO;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ResetPassword extends AbstractManager
{
    public function resetPassword($email): string
    {
        $password = bin2hex(random_bytes(10));
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'UPDATE User SET password = :password WHERE email = :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email, FILTER_VALIDATE_EMAIL);
        $statement->bindValue(':password', $passwordHash);
        $statement->execute();
        return $password;
    }

    public function getEmailVerify($email): array|bool
    {
        $query = 'SELECT email FROM User WHERE email = :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email, FILTER_VALIDATE_EMAIL);
        $statement->execute();
        return $statement->fetch();
    }
}

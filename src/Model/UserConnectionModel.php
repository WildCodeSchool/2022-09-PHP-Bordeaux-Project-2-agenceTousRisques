<?php

namespace App\Model;

class UserConnectionModel extends AbstractManager
{
    public function access($accessEmail, $accessPassword)
    {
        $query = 'SELECT email, password, isVisible FROM user WHERE email= :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $accessEmail, \PDO::PARAM_STR);
        $statement->execute();
        $isCredentialsFound = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$isCredentialsFound) {
            return false;
        } else {
            $passwordVerify = password_verify($accessPassword, $isCredentialsFound['password']);
            if ($passwordVerify && $isCredentialsFound['isVisible']) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function validation(array $logs)
    {
        $errors = [];
        if (!filter_var($logs['email'], FILTER_VALIDATE_EMAIL) || empty($logs['email'])) {
            $errors[] = 'veuillez saisir une adresse mail conforme';
        }
        if (empty($logs['password'])) {
            $errors[] = 'veuillez saisir votre mot de passe';
        }

        return $errors;
    }

    public function selectOneByEmail($email)
    {
        $query = 'SELECT * FROM user WHERE email= :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}

<?php

namespace App\Model;

use PDO;

class DeleteModel extends AbstractManager
{
    public function updateUser($email): bool


{           $sql = "UPDATE User SET isVisible = 0 WHERE email= :email";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue('email', $email , FILTER_VALIDATE_EMAIL);
            return $statement->execute();  
        }
        public function selectOneByEmail($email)
            {
                $query = 'SELECT * FROM User WHERE email= :email';
                $statement = $this->pdo->prepare($query);
                $statement->bindValue(':email', $email, \PDO::PARAM_STR);
                $statement->execute();
        
                return $statement->fetch();
            }}
            

        

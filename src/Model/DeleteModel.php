<?php

namespace App\Model;
use PDO;

class DeleteModel extends AbstractManager
{
   /* public function edit(){
    $SQL = 'INSERT INTO Item SET name = :name WHERE item_id = item_id';
$stmt = $this->pdo->prepare ($SQL);
$stmt -> execute(['firstname->$this->name', 'item_id'->$this->item_id],
(['lastname->$this->name', 'item_id'->$this->item_id]),
(['email->$this->name', 'item_id'->$this->item_id]));
    return $stmt->rowCount();
} */


public function updateUser($email): bool
{
            $SQL = "UPDATE User SET isVisible = 0 WHERE email= :email";
            $stmt = $this->pdo->prepare($SQL);
            $stmt->bindValue('email', $email , FILTER_VALIDATE_EMAIL);
            

            return $stmt->execute();   
}

public function selectOneByEmail($email)
    {
        $query = 'SELECT * FROM User WHERE email= :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }}
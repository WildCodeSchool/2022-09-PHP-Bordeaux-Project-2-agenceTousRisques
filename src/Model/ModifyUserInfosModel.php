<?php

namespace App\Model;

use PDO;

class ModifyUserInfosModel extends AbstractManager
{
    public function modifyUserInfos($firstname, $lastname, $telephone, $address, $email, $password)
    {
        $query = 'UPDATE `user`
                  SET firstname = :firstname,
                      lastname = :lastname,
                      telephone = :telephone,
                      address = :address,
                      email = :email,
                      password = :password
                  WHERE userID = ' . $_SESSION['user_id'];
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':telephone', $telephone, \PDO::PARAM_INT);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $statement->execute();
    }

    public function selectKids(): array
    {
        $query = "SELECT kidID, firstname, birthday, specs FROM `kid` WHERE userID =" . $_SESSION['user_id'];
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function updateKidsSpecs($kidID, $specs)
    {
        $query = "UPDATE `kid` SET specs = :specs WHERE kidID= :kidID";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':specs', htmlspecialchars($specs));
        $statement->bindValue(':kidID', $kidID, PDO::PARAM_INT);
        $statement->execute();
    }

    public function insertKid($user): void
    {
        if (!empty($user['firstnameKid']) && !empty($user['birthdayKid']) && !empty($user['commentKid'])) {
            $statementKid = $this->pdo->prepare("INSERT INTO Kid
                (`userID`,`firstname`, `birthday` , `specs`)
            VALUES
                (:userID , :firstname, :birthday , :specs)");
            $statementKid->bindValue('userID', $_SESSION['user_id'], PDO::PARAM_INT);
            $statementKid->bindValue('firstname', htmlspecialchars($user['firstnameKid']), PDO::PARAM_STR);
            $statementKid->bindValue('birthday', htmlspecialchars($user['birthdayKid']), PDO::PARAM_STR);
            $statementKid->bindValue('specs', htmlspecialchars($user['commentKid']), PDO::PARAM_STR);
            $statementKid->execute();
        }
    }


    public function insertKid2($user): void
    {
        if (!empty($user['firstnameKid2']) && !empty($user['birthdayKid2']) && !empty($user['commentKid2'])) {
            $statementKid = $this->pdo->prepare("INSERT INTO Kid
                (`userID`,`firstname`, `birthday` , `specs`)
            VALUES
                (:userID , :firstname, :birthday , :specs)");
            $statementKid->bindValue('userID', $_SESSION['user_id'], PDO::PARAM_INT);
            $statementKid->bindValue('firstname', htmlspecialchars($user['firstnameKid2']), PDO::PARAM_STR);
            $statementKid->bindValue('birthday', htmlspecialchars($user['birthdayKid2']), PDO::PARAM_STR);
            $statementKid->bindValue('specs', htmlspecialchars($user['commentKid2']), PDO::PARAM_STR);
            $statementKid->execute();
        }
    }


    public function insertKid3($user): void
    {
        if (!empty($user['firstnameKid3']) && !empty($user['birthdayKid3']) && !empty($user['commentKid3'])) {
            $statementKid = $this->pdo->prepare("INSERT INTO Kid
                (`userID`,`firstname`, `birthday` , `specs`)
            VALUES
                (:userID , :firstname, :birthday , :specs)");
            $statementKid->bindValue('userID', $_SESSION['user_id'], PDO::PARAM_INT);
            $statementKid->bindValue('firstname', htmlspecialchars($user['firstnameKid3']), PDO::PARAM_STR);
            $statementKid->bindValue('birthday', htmlspecialchars($user['birthdayKid3']), PDO::PARAM_STR);
            $statementKid->bindValue('specs', htmlspecialchars($user['commentKid3']), PDO::PARAM_STR);
            $statementKid->execute();
        }
    }
}

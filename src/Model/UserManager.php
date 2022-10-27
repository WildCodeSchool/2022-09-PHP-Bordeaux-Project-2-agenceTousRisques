<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    /**
     * Insert new item in database
     */
    public function insert(array $user): void
    {
        $statementUser = $this->pdo->prepare("INSERT INTO User
    (`email`, `password` , `avatar`,`activationCode`, `isAdmin`,`firstname` , `lastname` , `telephone` , `address` )
VALUES
    (:email, :password , :avatar ,:activationCode, :isAdmin , :firstname , :lastname , :telephone , :address)");

        $statementUser->bindValue('email', $user['emailUserInscription'], PDO::PARAM_STR);
        $statementUser->bindValue('password', $user['password'], PDO::PARAM_STR);
        $statementUser->bindValue('avatar', 1, PDO::PARAM_INT);
        $statementUser->bindValue('activationCode', $user['activationCode'], PDO::PARAM_INT);
        $statementUser->bindValue('isAdmin', false, PDO::PARAM_BOOL);
        $statementUser->bindValue('firstname', $user['firstname'], PDO::PARAM_STR);
        $statementUser->bindValue('lastname', $user['lastname'], PDO::PARAM_STR);
        $statementUser->bindValue('telephone', $user['telephone'], PDO::PARAM_INT);
        $statementUser->bindValue('address', $user['address'], PDO::PARAM_STR);
        $statementUser->execute();
    }

    public function getUserID($user)
    {
        $statementUserId = $this->pdo->query("SELECT userID FROM User
              WHERE email = '" . $user['emailUserInscription'] . "'");
        return $statementUserId->fetch();
    }

    public function insertKid($id, $user)
    {
        $statementKid = $this->pdo->prepare("INSERT INTO Kid
    (`userID`,`firstname`, `birthday` , `specs`)
VALUES
    (:userID , :firstname, :birthday , :specs)");
        $statementKid->bindValue('userID', $id['userID'], PDO::PARAM_INT);
        $statementKid->bindValue('firstname', $user['firstnameKid'], PDO::PARAM_STR);
        $statementKid->bindValue('birthday', $user['birthdayKid'], PDO::PARAM_STR);
        $statementKid->bindValue('specs', $user['commentKid'], PDO::PARAM_STR);
        $statementKid->execute();
    }
}

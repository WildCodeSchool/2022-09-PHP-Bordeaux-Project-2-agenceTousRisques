<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    /**
     * Insert new item in database
     */
    public function insertUser(array $user): void
    {
        $statementUser = $this->pdo->prepare("INSERT INTO User
    (`email`, `password` , `avatar`,`activationCode`, `isAdmin`,`firstname` , `lastname` , `telephone` , `address` )
VALUES
    (:email, :password , :avatar ,:activationCode, :isAdmin , :firstname , :lastname , :telephone , :address)");

        $statementUser->bindValue('email', htmlspecialchars($_GET['email']), FILTER_VALIDATE_EMAIL);
        $statementUser->bindValue('password', htmlspecialchars($user['password']), PDO::PARAM_STR);
        $statementUser->bindValue('avatar', 1, PDO::PARAM_INT);
        $statementUser->bindValue('activationCode', htmlspecialchars($_GET['code']), PDO::PARAM_INT);
        $statementUser->bindValue('isAdmin', false, PDO::PARAM_BOOL);
        $statementUser->bindValue('firstname', htmlspecialchars($user['firstname']), PDO::PARAM_STR);
        $statementUser->bindValue('lastname', htmlspecialchars($user['lastname']), PDO::PARAM_STR);
        $statementUser->bindValue('telephone', htmlspecialchars($user['telephone']), PDO::PARAM_INT);
        $statementUser->bindValue('address', htmlspecialchars($user['address']), PDO::PARAM_STR);
        $statementUser->execute();
    }

    public function getUserID($user)
    {
        $statementUserId = $this->pdo->query("SELECT userID FROM User
              WHERE email = '" . htmlspecialchars($user['emailUserInscription']) . "'");
        return $statementUserId->fetch();
    }

    public function insertKid($id, $user)
    {
        $statementKid = $this->pdo->prepare("INSERT INTO Kid
    (`userID`,`firstname`, `birthday` , `specs`)
VALUES
    (:userID , :firstname, :birthday , :specs)");
        $statementKid->bindValue('userID', htmlspecialchars($id['userID']), PDO::PARAM_INT);
        $statementKid->bindValue('firstname', htmlspecialchars($user['firstnameKid']), PDO::PARAM_STR);
        $statementKid->bindValue('birthday', htmlspecialchars($user['birthdayKid']), PDO::PARAM_STR);
        $statementKid->bindValue('specs', htmlspecialchars($user['commentKid']), PDO::PARAM_STR);
        $statementKid->execute();
    }
}

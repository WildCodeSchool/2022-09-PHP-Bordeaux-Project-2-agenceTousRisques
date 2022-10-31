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

    /**
     * @param $user
     * @return mixed
     * Récupération id parent
     */
    public function getUserID($user): array
    {
        $statementUserId = $this->pdo->query("SELECT userID FROM User
              WHERE email = '" . htmlspecialchars($_GET['email']) . "'");
        return $statementUserId->fetch();
    }

    /**
     * @param $id
     * @param $user
     * @return void
     * Insertion enfant lié à l'Id parent
     */
    public function insertKid($id, $user): void
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

    /**
     * @param $id
     * @param $user
     * @return void
     * Insertion enfant2 lié à l'Id parent
     */
    public function insertKid2($id, $user): void
    {
        $statementKid = $this->pdo->prepare("INSERT INTO Kid
    (`userID`,`firstname`, `birthday` , `specs`)
VALUES
    (:userID , :firstname, :birthday , :specs)");
        $statementKid->bindValue('userID', htmlspecialchars($id['userID']), PDO::PARAM_INT);
        $statementKid->bindValue('firstname', htmlspecialchars($user['firstnameKid2']), PDO::PARAM_STR);
        $statementKid->bindValue('birthday', htmlspecialchars($user['birthdayKid2']), PDO::PARAM_STR);
        $statementKid->bindValue('specs', htmlspecialchars($user['commentKid2']), PDO::PARAM_STR);
        $statementKid->execute();
    }

    /**
     * @param $id
     * @param $user
     * @return void
     * Insertion enfant3 lié à l'Id parent
     */
    public function insertKid3($id, $user): void
    {
        $statementKid = $this->pdo->prepare("INSERT INTO Kid
    (`userID`,`firstname`, `birthday` , `specs`)
VALUES
    (:userID , :firstname, :birthday , :specs)");
        $statementKid->bindValue('userID', htmlspecialchars($id['userID']), PDO::PARAM_INT);
        $statementKid->bindValue('firstname', htmlspecialchars($user['firstnameKid3']), PDO::PARAM_STR);
        $statementKid->bindValue('birthday', htmlspecialchars($user['birthdayKid3']), PDO::PARAM_STR);
        $statementKid->bindValue('specs', htmlspecialchars($user['commentKid3']), PDO::PARAM_STR);
        $statementKid->execute();
    }

    /**
     * @param $user
     * @return array
     */
    public function validFormCompletedUser($user): array
    {
        $errors = [];
        if (!isset($user['password']) || (empty(trim($user['password'])))) {
            $errors[] = 'Mot de passe obligatoire';
        }
        if ($user['password'] != $user['password2']) {
            $errors[] = 'Mots de passe différents';
        }
        if (!isset($user['firstname']) || (empty(trim($user['firstname'])))) {
            $errors[] = 'Prénom obligatoire';
        }
        if (!isset($user['lastname']) || (empty(trim($user['lastname'])))) {
            $errors[] = 'Nom obligatoire';
        }
        if (!isset($user['telephone']) || (empty(trim($user['telephone'])))) {
            $errors[] = 'Telephone obligatoire';
        }
        if (!isset($user['address']) || (empty(trim($user['address'])))) {
            $errors[] = 'Adresse obligatoire';
        }
        if (!isset($user['firstnameKid']) || (empty(trim($user['firstnameKid'])))) {
            $errors[] = 'Prénom enfant obligatoire';
        }
        if (!isset($user['birthdayKid']) || (empty(trim($user['birthdayKid'])))) {
            $errors[] = 'Date de naissance enfant obligatoire';
        }
        if (!isset($user['commentKid']) || (empty(trim($user['commentKid'])))) {
            $errors[] = 'Commentaires enfant obligatoire';
        }
        return $errors;
    }
}

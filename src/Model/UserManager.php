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
    (`email`, `password` , `avatar`,`activationCode`, `isAdmin`,`firstname`
    , `lastname` , `telephone` , `address`, `isVisible` )
VALUES
    (:email, :password , :avatar ,:activationCode, :isAdmin , :firstname
    , :lastname , :telephone , :address, :isVisible)");

        $statementUser->bindValue('email', htmlspecialchars($_GET['email']), FILTER_VALIDATE_EMAIL);
        $statementUser->bindValue('password', password_hash($user['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $statementUser->bindValue('avatar', 1, PDO::PARAM_INT);
        $statementUser->bindValue('activationCode', htmlspecialchars($_GET['code']), PDO::PARAM_INT);
        $statementUser->bindValue('isAdmin', false, PDO::PARAM_BOOL);
        $statementUser->bindValue('firstname', htmlspecialchars($user['firstname']), PDO::PARAM_STR);
        $statementUser->bindValue('lastname', htmlspecialchars($user['lastname']), PDO::PARAM_STR);
        $statementUser->bindValue('telephone', htmlspecialchars($user['telephone']), PDO::PARAM_INT);
        $statementUser->bindValue('address', htmlspecialchars($user['address']), PDO::PARAM_STR);
        $statementUser->bindValue('isVisible', true, PDO::PARAM_BOOL);
        $statementUser->execute();
    }

    /**
     * @return mixed
     * Récupération id parent
     */
    public function getUserID(): mixed
    {
        $statementUserId = $this->pdo->query("SELECT userID FROM User
              WHERE email = '" . htmlspecialchars($_GET['email']) . "'");
        return $statementUserId->fetch();
    }


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


    public function insertKid2($id, $user): void
    {
        if (!empty($user['firstnameKid2']) && !empty($user['birthdayKid2']) && !empty($user['commentKid2'])) {
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
    }


    public function insertKid3($id, $user): void
    {
        if (!empty($user['firstnameKid3']) && !empty($user['birthdayKid3']) && !empty($user['commentKid3'])) {
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
    }


    public function validFormCompletedUser($user): ?string
    {
        $errors = [];
        $errors = $this->issetInput($user['password'], 'Mot de passe obligatoire');
        $errors = $this->issetInput($user['firstname'], 'Prénom obligatoire');
        $errors = $this->issetInput($user['lastname'], 'Nom obligatoire');
        $errors = $this->issetInput($user['telephone'], 'Téléphone obligatoire');
        $errors = $this->issetInput($user['address'], 'Adresse obligatoire');
        $errors = $this->issetInput($user['firstnameKid'], 'Prénom enfant obligatoire');
        $errors = $this->issetInput($user['birthdayKid'], 'Date de naissance enfant obligatoire');
        $errors = $this->issetInput($user['commentKid'], 'Commentaires enfant obligatoire');
        if ($user['password'] != $user['password2']) {
            $errors[] = 'Mots de passe différents';
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

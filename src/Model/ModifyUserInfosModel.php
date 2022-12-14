<?php

namespace App\Model;

use PDO;

class ModifyUserInfosModel extends AbstractManager
{
    public function modifyUserInfos($infosUser)
    {
        $query = 'UPDATE `User`
                  SET firstname = :firstname,
                      lastname = :lastname,
                      telephone = :telephone,
                      address = :address
                  WHERE userID = ' . $_SESSION['user_id'];
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':firstname', $infosUser['firstname']);
        $statement->bindValue(':lastname', $infosUser['lastname']);
        $statement->bindValue(':telephone', $infosUser['telephone'], \PDO::PARAM_INT);
        $statement->bindValue(':address', $infosUser['address']);
        $statement->execute();
    }

    public function modifyUserLogins(array $newLogins)
    {
        $query = "UPDATE `User` SET password = :newPassword, email = :newEmail WHERE userID =" . $_SESSION['user_id'];
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':newPassword', password_hash($newLogins['password1'], PASSWORD_DEFAULT));
        $statement->bindValue(':newEmail', $newLogins['email']);
        $statement->execute();
    }

    public function selectKids(): array
    {
        $query = "SELECT kidID, firstname, birthday, specs FROM `Kid` WHERE userID =" . $_SESSION['user_id'];
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function updateKidsSpecs($kidID, $specs)
    {
        $query = "UPDATE `Kid` SET specs = :specs WHERE kidID= :kidID";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':specs', htmlspecialchars($specs));
        $statement->bindValue(':kidID', $kidID, PDO::PARAM_INT);
        $statement->execute();
    }

    public function updateAvatar($avatarId)
    {
        $query = "UPDATE `User` SET avatar = :avatar WHERE userID = :userID";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':avatar', $avatarId, PDO::PARAM_INT);
        $statement->bindValue(':userID', $_SESSION['user_id'], PDO::PARAM_INT);
        $statement->execute();
    }
}

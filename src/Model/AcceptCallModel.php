<?php

namespace App\Model;

class AcceptCallModel extends AbstractManager
{
    public function acceptCall()
    {
        $query = "UPDATE `call` SET `helperID` =" . $_SESSION['user_id'] . " WHERE `callID` =" . $_GET['id'];

        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function getDataFromCallID($id): array
    {
        $query = "SELECT email, C.startdate FROM user INNER JOIN `Call` as C
    ON C.userID=user.userID WHERE C.callID=" . $id;
        $statement = $this->pdo->query($query);
        return $statement->fetch();
    }
}

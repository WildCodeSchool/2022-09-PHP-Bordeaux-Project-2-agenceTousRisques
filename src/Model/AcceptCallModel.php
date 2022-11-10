<?php

namespace App\Model;

class AcceptCallModel extends AbstractManager
{
    public function acceptCall()
    {
        $query = "UPDATE `Call` SET `helperID` =" . $_SESSION['user_id'] . " WHERE `callID` =" . $_GET['id'];
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }
}

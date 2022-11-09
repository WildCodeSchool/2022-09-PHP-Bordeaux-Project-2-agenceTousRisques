<?php

namespace App\Model;

class UserSliderManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectAll(): array
    {
        $statementUser = $this->pdo->prepare('SELECT firstname, A.image FROM User
INNER JOIN Avatar A on User.avatar = A.avatarID WHERE isVisible = 1');
        $statementUser->execute();
        return $statementUser->fetchAll();
    }
}

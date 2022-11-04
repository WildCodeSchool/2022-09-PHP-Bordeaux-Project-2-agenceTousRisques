<?php

namespace App\Controller;

class UserPageController extends AbstractController
{
    public function showUserPage()
    {
        return $this->twig->render('UserPage/index.html.twig');
    }
}

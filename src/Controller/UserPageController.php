<?php

namespace App\Controller;

class UserPageController extends AbstractController
{
    public function showUserPage()
    {
        $userSliderController = new UserSliderController();
        $team = $userSliderController->show();
        return $this->twig->render('UserPage/index.html.twig', ['team' => $team]);
    }
}

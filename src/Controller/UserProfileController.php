<?php

namespace App\Controller;

class UserProfileController extends AbstractController
{
    public function showUserProfile(): string
    {
        return $this->twig->render('UserProfile/showUserProfile.html.twig');
    }
}

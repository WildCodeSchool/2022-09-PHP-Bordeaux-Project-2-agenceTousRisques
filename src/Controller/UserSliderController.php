<?php

namespace App\Controller;

use App\Model\UserSliderManager;

class UserSliderController extends AbstractController
{
    public function show()
    {
        $userSliderManager = new UserSliderManager();
        return $userSliderManager->selectAll();
    }
}

<?php

namespace App\Controller;

use App\Model\UserUnacceptedDemand;

class UserUnacceptedDemandController extends AbstractController
{
    public function show()
    {
        $userSliderManager = new UserUnacceptedDemand();
        return $userSliderManager->getUnaccepted();
    }
}

<?php

namespace App\Controller;

use App\Model\ModifyUserInfosModel;

class ValidateModifiedProfileController extends AbstractController
{
    public function validateModifiedInfos(array $infosUser): array
    {
        $errors = [];
        if (empty($infosUser['firstname'])) {
            $errors[] = 'Prénom obligatoire';
        }
        if (empty($infosUser['lastname'])) {
            $errors[] = 'Nom obligatoire';
        }
        if (empty($infosUser['telephone'])) {
            $errors[] = 'téléphone obligatoire';
        }
        if (empty($infosUser['address'])) {
            $errors[] = 'adresse postale obligatoire';
        }
        return $errors;
    }

    public function validateModifiedLogin($infosUser): array
    {
        $errors = [];
        if (!filter_var($infosUser['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'E-mail obligatoire';
        }
        if (isset($infosUser['password1']) || isset($infosUser['password2'])) {
            if ($infosUser['password1'] !== $infosUser['password2']) {
                $errors[] = 'Mots de passe differents';
            } else {
                $modifyUserInfos = new ModifyUserInfosModel();
                $modifyUserInfos->modifyUserLogins($infosUser);
            }
        }
        return $errors;
    }

    public function validateModifiedKid($infosUser): array
    {
        $errors = [];
        if (isset($infosUser['commentKid0']) && empty($infosUser['commentKid0'])) {
            $errors[] = 'Un commentaire pour vos enfants est obligatoire';
        }
        if (isset($infosUser['commentKid1']) && empty($infosUser['commentKid1'])) {
            $errors[] = 'Un commentaire pour vos enfants est obligatoire';
        }
        if (isset($infosUser['commentKid2']) && empty($infosUser['commentKid2'])) {
            $errors[] = 'Un commentaire pour vos enfants est obligatoire';
        }
        return $errors;
    }
}

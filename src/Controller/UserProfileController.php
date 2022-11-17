<?php

namespace App\Controller;

use App\Model\ModifyUserInfosModel;

class UserProfileController extends AbstractController
{
    public function showUserProfile(): string
    {
        $kidsInfos = new ModifyUserInfosModel();
        $userKids = $kidsInfos->selectKids();
        return $this->twig->render('UserProfile/showUserProfile.html.twig', [
            'kids' => $userKids
        ]);
    }

    public function modifyUserProfile(): string
    {
        $kidsInfos = new ModifyUserInfosModel();
        $userKids = $kidsInfos->selectKids();
        return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
            'kids' => $userKids
        ]);
    }

    public function modifyUserInfos(): string
    {
        $errorsTotal = [];
        $validateUserInfos = new ValidateModifiedProfileController();
        $modifyUserInfos = new ModifyUserInfosModel();
        $userKids = $modifyUserInfos->selectKids();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $errorsTotal = $validateUserInfos->validateModifiedInfos($infosUser);
            if (empty($errorsTotal)) {
                $modifyUserInfos->modifyUserInfos($infosUser);
                echo "<script>alert('Vos informations ont bien été modifiées.')</script>";
                header('Refresh:0 userProfile');
            } else {
                return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
                    'errors' => $errorsTotal,
                    'kids' => $userKids
                ]);
            }
        }

        return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
            'kids' => $userKids
        ]);
    }

    public function modifyLoginInfos(): string
    {
        $errorsTotal = [];
        $modifyUserInfos = new ModifyUserInfosModel();
        $validateUserInfos = new ValidateModifiedProfileController();
        $userKids = $modifyUserInfos->selectKids();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $errorsTotal = $validateUserInfos->validateModifiedLogin($infosUser);
            if (empty($errorsTotal)) {
                $modifyUserInfos->modifyUserLogins($infosUser);
                echo "<script>alert('Vos informations ont bien été modifiées.')</script>";
                header('Refresh:0 userProfile');
            } else {
                return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
                    'errors' => $errorsTotal,
                    'kids' => $userKids
                ]);
            }
        }

        return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
            'kids' => $userKids
        ]);
    }

    public function modifyKidInfos(): string
    {
        $errorsTotal = [];
        $modifyUserInfos = new ModifyUserInfosModel();
        $validateUserInfos = new ValidateModifiedProfileController();
        $userKids = $modifyUserInfos->selectKids();
        $kidIDs = [];
        foreach ($userKids as $kids) {
            $kidIDs[] = $kids['kidID'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $errorsTotal = $validateUserInfos->validateModifiedKid($infosUser);
            if (empty($errorsTotal)) {
                for ($i = 0; $i < \count($kidIDs); $i++) {
                    $kidID = $kidIDs[$i];
                    $modifyUserInfos->updateKidsSpecs($kidID, $infosUser['commentKid' . $i]);
                }
                echo "<script>alert('Vos informations ont bien été modifiées.')</script>";
                header('Refresh:0 userProfile');
            } else {
                return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
                    'errors' => $errorsTotal,
                    'kids' => $userKids
                ]);
            }
        }

        return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
            'kids' => $userKids
        ]);
    }
}

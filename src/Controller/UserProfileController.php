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
        $errorsInfos = [];
        $validateUserInfos = new ValidateModifiedProfileController();
        $modifyUserInfos = new ModifyUserInfosModel();
        $userKids = $modifyUserInfos->selectKids();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $errorsInfos = $validateUserInfos->validateModifiedInfos($infosUser);
            if (empty($errorsInfos)) {
                $modifyUserInfos->modifyUserInfos($infosUser);
                echo "<script>alert('Vos informations ont bien été modifiées.')</script>";
                header('Refresh:0 userProfile');
            } else {
                return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
                    'errorsInfos' => $errorsInfos,
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
        $errorsLogs = [];
        $modifyUserInfos = new ModifyUserInfosModel();
        $validateUserInfos = new ValidateModifiedProfileController();
        $userKids = $modifyUserInfos->selectKids();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $errorsLogs = $validateUserInfos->validateModifiedLogin($infosUser);
            if (empty($errorsLogs)) {
                $modifyUserInfos->modifyUserLogins($infosUser);
                echo "<script>alert('Vos informations ont bien été modifiées.')</script>";
                header('Refresh:0 userProfile');
            } else {
                return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
                    'errorsLogs' => $errorsLogs,
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
        $errorsKids = [];
        $modifyUserInfos = new ModifyUserInfosModel();
        $validateUserInfos = new ValidateModifiedProfileController();
        $userKids = $modifyUserInfos->selectKids();
        $kidIDs = [];
        foreach ($userKids as $kids) {
            $kidIDs[] = $kids['kidID'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $errorsKids = $validateUserInfos->validateModifiedKid($infosUser);
            if (empty($errorsKids)) {
                for ($i = 0; $i < \count($kidIDs); $i++) {
                    $kidID = $kidIDs[$i];
                    $modifyUserInfos->updateKidsSpecs($kidID, $infosUser['commentKid' . $i]);
                }
                echo "<script>alert('Vos informations ont bien été modifiées.')</script>";
                header('Refresh:0 userProfile');
            } else {
                return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
                    'errorsKids' => $errorsKids,
                    'kids' => $userKids
                ]);
            }
        }

        return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
            'kids' => $userKids
        ]);
    }

    public function modifyAvatar(): string
    {
        $modifyUserInfos = new ModifyUserInfosModel();
        $userKids = $modifyUserInfos->selectKids();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $modifyUserInfos = new ModifyUserInfosModel();
            $modifyUserInfos->updateAvatar($infosUser['submitAvatar']);
        }
        echo "<script>alert('Vos informations ont bien été modifiées.')</script>";
        header('Refresh:0 userProfile');
        return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
            'kids' => $userKids
        ]);
    }
}

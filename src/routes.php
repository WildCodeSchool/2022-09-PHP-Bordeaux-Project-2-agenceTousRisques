<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'userConnection' => ['UserConnectionController', 'access'],
    'userInscription' => ['UserInscriptionController', 'add'],
    'gestion' => ['AdminController', 'administrationPanel'],
    'adminInvite' => ['AdminController', 'inviteUserForm',],
    'invite' => ['AdminController', 'inviteUser'],
    'delete' => ['AdminController', 'delete'],
    'addDemand' => ['AddDemandController', 'add'],
    'logout' => ['UserConnectionController', 'logout'],
    'UserPage' => ['UserPageController', 'showUserPage'],
    'userCalls' => ['UserCallsController', 'showUserCalls'],
    'userProfile' => ['UserProfileController', 'showUserProfile'],
    'modifyProfile' => ['UserProfileController', 'modifyUserProfile'],
    'modifyUserProfile' => ['UserProfileController', 'modifyUserInfos'],
    'modifyLoginProfile' => ['UserProfileController', 'modifyLoginInfos'],
    'modifyKidProfile' => ['UserProfileController', 'modifyKidInfos']
];

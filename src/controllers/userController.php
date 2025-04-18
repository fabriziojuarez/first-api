<?php

require_once "./../models/functions/UserDao.php";
require_once "./../models/seeds/User.php";

$dao = new UserDao();

switch($_SERVER['REQUEST_METHOD']){
    case "GET":{
        if(!empty($_GET['id'])){
            $dao->show($_GET['id']);
            break;
        }
        $dao->index();
        break;
    }
    case "POST":{
        $user = new User();
        $user->setName($_POST['name']);
        $user->setLastname($_POST['lastname']);
        $user->setPhone($_POST['phone']);

        $dao->store($user);
        break;
    }
    case "PUT":{
        $user = new User();
        $user->setId($_REQUEST['id']);
        $user->setName($_REQUEST['name']);
        $user->setLastname($_REQUEST['lastname']);
        $user->setPhone($_REQUEST['phone']);

        $dao->update($user);
        break;
    };
    case "DELETE":{
        $dao->delete($_REQUEST['id']);
        break;
    }
}
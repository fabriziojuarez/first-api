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
        
        break;
    }
    case "DELETE":{
        break;
    }
}
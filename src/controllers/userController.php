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
        $user->setName(null);
        $user->setLastname(null);
        $user->setPhone(null);

        if(!empty($_REQUEST['name'])){
            $user->setName($_POST['name']);
        }
        if(!empty($_REQUEST['lastname'])){
            $user->setLastname($_POST['lastname']);
        }
        if(!empty($_REQUEST['phone'])){
            $user->setPhone($_POST['phone']);
        }

        $dao->store($user);
        break;
    }
    case "PUT":{
        $user = new User();
        $user->setId(null);
        $user->setName(null);
        $user->setLastname(null);
        $user->setPhone(null);

        if(!empty($_REQUEST['id'])){
            $user->setId($_REQUEST["id"]);
        }
        if(!empty($_REQUEST['name'])){
            $user->setName($_REQUEST['name']);
        }
        if(!empty($_REQUEST['lastname'])){
            $user->setLastname($_REQUEST['lastname']);
        }
        if(!empty($_REQUEST['phone'])){
            $user->setPhone($_REQUEST['phone']);
        }

        $dao->update($user);
        break;
    }
    case "DELETE":{
        $id = null;
        if(!empty($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }
        $dao->delete($id);
        break;
    }
}
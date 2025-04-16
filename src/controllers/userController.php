<?php

require_once "./../models/functions/UserDao.php";

$dao = new UserDao();

switch($_SERVER['REQUEST_METHOD']){
    case "GET":{
        $dao->index();
        break;
    }
    case "POST":{
        break;
    }
    case "PUT":{
        break;
    }
    case "DELETE":{
        break;
    }
}
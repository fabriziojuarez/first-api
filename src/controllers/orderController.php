<?php

require_once "./../models/functions/OrderDao.php";

header('Content-Type: application/json');

$dao = new OrderDao();

switch($_SERVER['REQUEST_METHOD']){
    case "GET":{
        $dao->index();
        break;
    }
    case "POST":{

    }
    case "PUT":{

    }
    case "DELETE":{

    }
}

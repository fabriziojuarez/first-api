<?php

require_once "./../models/functions/OrderDao.php";
require_once "./../models/seeds/Order.php";

header('Content-Type: application/json');

$dao = new OrderDao();

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
        $order = new Order();
        $order->setUser(null);
        $order->setItem(null);
        $order->setQuantity(null);
        $order->setPrice(null);

        if(!empty($_POST['user'])){
            $order->setUser($_POST['user']);
        }
        if(!empty($_POST['item'])){
            $order->setItem($_POST['item']);
        }
        if(!empty($_POST['quantity'])){
            $order->setQuantity($_POST['quantity']);
        }
        if(!empty($_POST['price'])){
            $order->setPrice($_POST['price']);
        }

        $dao->store($order);
        break;
    }
    case "PUT":{
        $order = new Order();
        $order->setId(null);
        $order->setUser(null);
        $order->setItem(null);
        $order->setQuantity(null);
        $order->setPrice(null);

        if(!empty($_REQUEST['id'])){
            $order->setId($_REQUEST['id']);
        }
        if(!empty($_REQUEST['user'])){
            $order->setUser($_REQUEST['user']);
        }
        if(!empty($_REQUEST['item'])){
            $order->setItem($_REQUEST['item']);
        }
        if(!empty($_REQUEST['quantity'])){
            $order->setQuantity($_REQUEST['quantity']);
        }
        if(!empty($_REQUEST['price'])){
            $order->setPrice($_REQUEST['price']);
        }

        $dao->update($order);
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

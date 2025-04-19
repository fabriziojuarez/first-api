<?php

require_once "./../config/connection.php";
require_once "./../models/seeds/Order.php";

header('Content-Type: application/json; charset=utf-8');

class OrderDao
{
    public function index()
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();
            $response = array();

            $query = "SELECT * FROM orders";
            $sql = mysqli_query($con, $query);

            $order = array();
            $orders = array();
            foreach (mysqli_fetch_all($sql) as $fila) {
                $order['id']       = $fila[0];
                $order['user']     = $fila[1];
                $order['item']     = $fila[2];
                $order['quantity'] = $fila[3];
                $order['price']    = $fila[4];
                array_push($orders, $order);
            }

            mysqli_close($con);
            $response['status'] = 200;
            $response['orders'] = $orders;
        } catch (Exception $e) {
            mysqli_close($con);
            $response['status'] = 500;
            $response['error'] = $e->getMessage();
        }
        http_response_code($response['status']);
        echo json_encode($response);
    }

    public function show($id)
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();

            $query = "SELECT * FROM orders WHERE id_order = $id";
            $sql = mysqli_query($con, $query);
            $res = mysqli_fetch_row($sql);

            if (is_null($res)) {
                mysqli_close($con);
                $response['status'] = 404;
                $response['error'] = "Order no encontrada";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }

            $order['id']        = $res[0];
            $order['user']      = $res[1];
            $order['item']      = $res[2];
            $order['quantity']  = $res[3];
            $order['price']     = $res[4];

            mysqli_close($con);
            $response['status'] = 200;
            $response['order'] = $order;
        } catch (Exception $e) {
            mysqli_close($con);
            $response['status'] = 500;
            $response['error'] = $e->getMessage();
        }
        http_response_code($response['status']);
        echo json_encode($response);
    }

    public function store(Order $order)
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();

            if(empty($order->getUser())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta usuario de la orden";
                echo json_encode($response);
                return;
            }
            if(empty($order->getItem())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta producto de la orden";
                echo json_encode($response);
                return;
            }
            if(empty($order->getQuantity())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta cantidad de la orden";
                echo json_encode($response);
                return;
            }
            if(empty($order->getPrice())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta precio de la orden";
                echo json_encode($response);
                return;
            }

            $user = $order->getUser();
            $item = $order->getItem();
            $quantity = $order->getQuantity();
            $price = $order->getPrice();

            $query = "INSERT INTO orders(
                user_order, 
                item_order, 
                quantity_order, 
                price_order) VALUES(
                '$user', 
                '$item', 
                '$quantity', 
                '$price')";
            mysqli_query($con, $query);

            if (mysqli_affected_rows($con) == 0) {
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Error en Insertar orden";
                echo json_encode($response);
                return;
            }

            mysqli_close($con);
            $response['status'] = 201;
            $response['msg'] = "Orden agregada correctamente";
        } catch (Exception $e) {
            mysqli_close($con);
            $response['status'] = 500;
            $response['error'] = $e->getMessage();
        }
        http_response_code($response['status']);
        echo json_encode($response);
    }

    public function update(Order $order)
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();

            if(empty($order->getId())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta id de la orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }
            if(empty($order->getUser())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta usuario de la orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }
            if(empty($order->getItem())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta producto de la orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }
            if(empty($order->getQuantity())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta cantidad de la orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }
            if(empty($order->getPrice())){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta precio de la orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }

            $id = $order->getId();
            $user = $order->getUser();
            $item = $order->getItem();
            $quantity = $order->getQuantity();
            $price = $order->getPrice();

            $query = "UPDATE orders SET 
                user_order = '$user', 
                item_order = '$item',
                quantity_order = '$quantity',
                price_order = '$price' 
                WHERE id_order = $id";
            mysqli_query($con, $query);

            if (mysqli_affected_rows($con) == 0) {
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Error en Actualizar orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }

            mysqli_close($con);
            $response['status'] = 205;
            $response['msg'] = "Ordeb actualizado correctamente";
        } catch (Exception $e) {
            mysqli_close($con);
            $response['status'] = 500;
            $response['error'] = $e->getMessage();
        }
        http_response_code($response['status']);
        echo json_encode($response);
    }

    public function delete($id)
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();

            if(empty($id)){
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Falta el id de la orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }

            $query = "DELETE FROM orders WHERE id_order=$id";
            mysqli_query($con, $query);

            if (mysqli_affected_rows($con) == 0) {
                mysqli_close($con);
                $response['status'] = 400;
                $response['error'] = "Error en eliminar orden";
                http_response_code($response['status']);
                echo json_encode($response);
                return;
            }

            mysqli_close($con);
            $response['status'] = 202;
            $response['error'] = "Orden eliminada correctamente";
        } catch (Exception $e) {
            mysqli_close($con);
            $response['status'] = 500;
            $response['error'] = $e->getMessage();
        }
        http_response_code($response['status']);
        echo json_encode($response);
    }
}

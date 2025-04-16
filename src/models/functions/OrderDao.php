<?php

require_once "./../config/connection.php";

class OrderDao
{
    public function index()
    {
        try {
            $obj = new connectionDb();
            $con = $obj->getConnection();

            $query = "SELECT * FROM orders";
            $results = mysqli_query($con, $query);

            $res = array();
            $order = array();
            foreach (mysqli_fetch_all($results) as $fila) {
                $order['id']        = $fila[0];
                $order['user']      = $fila[1];
                $order['item']      = $fila[2];
                $order['quantily']  = $fila[3];
                $order['price']     = $fila[4];
                array_push($res, $order);
            }
            $response['status'] = 202;
            $response['orders'] = $res;
        } catch (Exception $e) {
            $response['status'] = 444;
            $response['error'] = $e->getMessage();
        }
        echo json_encode($response);
    }
}

<?php

require_once "./../config/connection.php";

header('Content-Type: application/json; charset=utf-8');

class UserDao
{
    public function index()
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();
            $response = array();

            $query = "SELECT * FROM users";
            $sql = mysqli_query($con, $query);
            mysqli_close($con);

            $user = array();
            $res = array();
            foreach (mysqli_fetch_all($sql) as $fila) {
                $user['id']       = $fila[0];
                $user['name']     = $fila[1];
                $user['lastname'] = $fila[2];
                $user['phone']    = $fila[3];
                array_push($res, $user);
            }

            $response['status'] = 202;
            $response['users'] = $res;
        } catch (Exception $e) {
            $response['status'] = 444;
            $response['error'] = $e->getMessage();
        }
        echo json_encode($response);
    }

    public function store(){
        
    }
}
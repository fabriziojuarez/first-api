<?php

use function PHPSTORM_META\map;

require_once "./../config/connection.php";
require_once "./../models/seeds/User.php";

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

            $user = array();
            $users = array();
            foreach (mysqli_fetch_all($sql) as $fila) {
                $user['id']       = $fila[0];
                $user['name']     = $fila[1];
                $user['lastname'] = $fila[2];
                $user['phone']    = $fila[3];
                array_push($users, $user);
            }

            mysqli_close($con);
            $response['status'] = 202;
            $response['users'] = $users;
            echo json_encode($response);
        } catch (Exception $e) {
            $response['status'] = 444;
            $response['error'] = $e->getMessage();
            echo json_encode($response);
            return;
        }
    }

    public function show($id)
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();

            $query = "SELECT * FROM users WHERE id_user = $id";
            $sql = mysqli_query($con, $query);
            $res = mysqli_fetch_row($sql);

            if (is_null($res)) {
                $response['status'] = 401;
                $response['error'] = "User no encontrado";
                echo json_encode($response);
                return;
            }

            $user['id']         = $res[0];
            $user['name']       = $res[1];
            $user['lastname']   = $res[2];
            $user['phone']      = $res[3];

            $response['status'] = 400;
            $response['user'] = $user;
            echo json_encode($response);
        } catch (Exception $e) {
            $response['status'] = 444;
            $response['error'] = $e->getMessage();
            echo json_encode($response);
            return;
        }
    }

    public function store(User $user)
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();

            $name = $user->getName();
            $lastname = $user->getLastname();
            $phone = $user->getPhone();

            $query = "INSERT INTO users(
                name_user, 
                lastname_user, 
                phone_user) VALUES(
                '$name', 
                '$lastname', 
                '$phone')";
            mysqli_query($con, $query);

            if (mysqli_affected_rows($con) == 0) {
                $response['status'] = 401;
                $response['error'] = "Error en Insertar usuario";
                echo json_encode($response);
                return;
            }

            mysqli_close($con);
            $response['status'] = 201;
            $response['msg'] = "User agregado correctamente";
            echo json_encode($response);
        } catch (Exception $e) {
            $response['status'] = 444;
            $response['error'] = $e->getMessage();
            echo json_encode($response);
            return;
        }
    }

    public function update($id, $user)
    {
        try {
            $obj = new ConnectionDb();
            $con = $obj->getConnection();
        } catch (Exception $e) {
        }
    }
}
